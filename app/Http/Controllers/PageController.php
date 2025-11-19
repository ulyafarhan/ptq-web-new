<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Structure;
use App\Models\Program;
use App\Models\Milestone;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Halaman Beranda (Home)
     * Mengambil data setting global & berita terbaru.
     */
    public function home()
    {
        // Ambil Setting dari DB
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        // Ambil 3 Berita Terbaru
        $latestPosts = Post::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => Str::limit(strip_tags($post->content), 120),
                'published_at' => $post->published_at->format('d M Y'),
                'cover' => $post->getFirstMediaUrl('default', 'thumb'),
            ]);

        return Inertia::render('Home', [
            'latestPosts' => $latestPosts,
            // Data Hero & Kontak Dinamis
            'siteConfig' => [
                'hero_title' => $settings['hero_title'] ?? 'Membumikan Al-Qur\'an Di Kampus Jantong Hatee',
                'hero_desc' => $settings['hero_desc'] ?? 'Wadah pengembangan minat dan bakat mahasiswa Universitas Malikussaleh.',
                'register_url' => $settings['register_url'] ?? null,
                'contact' => [
                    'email' => $settings['contact_email'] ?? 'ukmptq@unimal.ac.id',
                    'address' => $settings['contact_address'] ?? 'Sekretariat UKM PTQ',
                ]
            ]
        ]);
    }

    /**
     * Halaman Struktur Organisasi
     */
    public function structure()
    {
        // Pengurus Teras (Inti)
        $teras = Structure::where('is_active', true)
            ->where('group_type', 'teras')
            ->orderBy('sort_order')
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'photo' => $item->getFirstMediaUrl('default', 'thumb'),
            ]);

        // Divisi (Grouped)
        $divisions = Structure::where('is_active', true)
            ->where('group_type', 'division')
            ->orderBy('division_name')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('division_name')
            ->map(fn($group, $name) => [
                'name' => $name,
                'members' => $group->map(fn($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'level' => $item->level,
                    'photo' => $item->getFirstMediaUrl('default', 'thumb'),
                ])
            ]);

        return Inertia::render('Structure', [
            'teras' => $teras,
            'divisions' => $divisions
        ]);
    }

    /**
     * Halaman Sejarah & Visi Misi
     */
    public function history()
    {
        // Ambil Data Milestone dari DB
        $milestones = Milestone::orderBy('year', 'asc')->get()->map(fn($m) => [
            'year' => $m->year,
            'title' => $m->title,
            'desc' => $m->description,
        ]);

        return Inertia::render('Profile/History', [
            'milestones' => $milestones // Kirim ke Vue
        ]);
    }

    /**
     * Halaman Program Kerja
     */
    public function programs()
    {
        // Ambil Program, Mapping Data, dan Grouping by Tipe
        $programs = Program::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($p) => [
                'title' => $p->title,
                'desc' => $p->description,
                'schedule' => $p->schedule,
                'location' => $p->location,
                'type' => $p->type, // rutin, bulanan, tahunan
                'status' => $p->status,
                'month' => $p->created_at->format('F Y'),
                'image' => $p->getFirstMediaUrl('default'), // Gambar Poster
                // Default styling fallback
                'icon' => 'book-open', 
                'color' => 'bg-emerald-100 text-emerald-600'
            ])
            ->groupBy('type');

        return Inertia::render('Profile/Programs', [
            'programs' => $programs
        ]);
    }

    /**
     * Halaman Index Berita (Search & Pagination)
     */
    public function posts(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest('published_at')
            ->paginate(9)
            ->withQueryString()
            ->through(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => Str::limit(strip_tags($post->content), 120),
                'published_at' => $post->published_at->format('d M Y'),
                'cover' => $post->getFirstMediaUrl('default', 'thumb'),
            ]);

        return Inertia::render('Post/Index', [
            'posts' => $posts,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Halaman Detail Berita
     */
    public function post(Post $post)
    {
        abort_if($post->status !== 'published', 404);

        return Inertia::render('Post/Show', [
            'post' => [
                'title' => $post->title,
                'content' => $post->content,
                'published_at' => $post->published_at->format('d F Y'),
                'author' => $post->author->name ?? 'Admin',
                'cover' => $post->getFirstMediaUrl('default', 'banner'),
            ]
        ]);
    }
}