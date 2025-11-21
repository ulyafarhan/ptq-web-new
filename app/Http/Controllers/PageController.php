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
     * 1. HALAMAN BERANDA (HOME)
     * Mengambil data Pengaturan Website (SiteSetting) dan Berita Terbaru.
     */
    public function home()
    {
        // 1. Ambil Settings (Konfigurasi Global)
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        // 2. Ambil Berita Terbaru (Latest Posts)
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
                // Menggunakan placeholder jika tidak ada cover
                'cover' => $post->getFirstMediaUrl('default') ?: asset('images/placeholder-image.jpg'),
            ]);

        // 3. Ambil Struktur Pengurus (Members) - BARU
        $structures = Structure::where('is_active', true)
            ->orderBy('level', 'asc')      // Level 1 (Ketua) duluan
            ->orderBy('sort_order', 'asc') // Lalu urutan manual
            ->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'group_type' => $item->group_type,
                'division_name' => $item->division_name,
                // Ambil URL foto atau fallback ke default avatar
                'image' => $item->getFirstMediaUrl('default') 
                    ? $item->getFirstMediaUrl('default') 
                    : asset('images/default-avatar.png'),
            ]);

        // 4. Return ke Inertia (Frontend)
        return Inertia::render('Home', [
            'latestPosts' => $latestPosts,
            'structures' => $structures, // <-- Data Pengurus dikirim di sini
            
            // Data Konfigurasi Dinamis
            'siteConfig' => [
                'hero_title' => $settings['hero_title'] ?? null,
                'hero_desc' => $settings['hero_desc'] ?? null,
                'register_url' => $settings['register_url'] ?? null,
                'contact' => [
                    'email' => $settings['contact_email'] ?? 'ukmptq@unimal.ac.id',
                    'address' => $settings['contact_address'] ?? 'Sekretariat UKM PTQ',
                    // Tambahkan Sosmed agar Footer dinamis juga
                    'instagram' => $settings['social_instagram'] ?? null,
                    'whatsapp' => $settings['social_whatsapp'] ?? null,
                    'youtube' => $settings['social_youtube'] ?? null,
                    'tiktok' => $settings['social_tiktok'] ?? null,
                ]
            ]
        ]);
    }

    /**
     * 2. HALAMAN STRUKTUR ORGANISASI
     * Mengambil data Pengurus Teras dan Divisi.
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

        // Divisi (Dikelompokkan berdasarkan nama divisi)
        $divisions = Structure::where('is_active', true)
            ->where('group_type', 'division')
            ->orderBy('division_name')
            ->orderBy('level') // Ketua dulu (level 1), baru anggota
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
     * 3. HALAMAN SEJARAH & VISI MISI
     * Mengambil data Milestone (Sejarah).
     */
    public function history()
    {
        // Ambil Milestone urut tahun
        $milestones = Milestone::orderBy('year', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(fn($m) => [
                'year' => $m->year,
                'title' => $m->title,
                'desc' => $m->description,
            ]);

        return Inertia::render('Profile/History', [
            'milestones' => $milestones
        ]);
    }

    /**
     * 4. HALAMAN PROGRAM KERJA
     * Mengambil data Program dan mengelompokkannya (Rutin/Bulanan/Tahunan).
     */
    public function programs()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        $programs = Program::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($p) => [
                'title' => $p->title,
                'desc' => $p->description,
                'schedule' => $p->schedule,
                'location' => $p->location,
                'type' => $p->type, // 'rutin', 'bulanan', 'tahunan'
                'status' => $p->status,
                'month' => $p->created_at->format('F Y'),
                // Ambil gambar poster program
                'image' => $p->getFirstMediaUrl('default'), 
                // Fallback icon/warna (bisa juga disimpan di DB jika mau lebih dinamis)
                'icon' => 'book-open', 
                'color' => 'bg-emerald-100 text-emerald-600'
            ])
            ->groupBy('type'); // Hasilnya: { rutin: [...], bulanan: [...], ... }

        return Inertia::render('Profile/Programs', [
            'programs' => $programs,
            'scheduleUrl' => $settings['schedule_file_url'] ?? null,
        ]);
    }

    /**
     * 5. HALAMAN ARSIP BERITA (INDEX)
     * Fitur Pencarian dan Pagination.
     */
    public function posts(Request $request)
    {
        $query = Post::where('status', 'published');

        // Fitur Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest('published_at')
            ->paginate(9) // 9 Berita per halaman
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
     * 6. HALAMAN DETAIL BERITA (SHOW)
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
                'cover' => $post->getFirstMediaUrl('default', 'banner'), // Gambar ukuran besar
            ]
        ]);
    }

    public function postShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail(); 

        $postData = [
            'title' => $post->title,
            'content' => $post->content, 
            'published_at' => $post->published_at->format('d F Y'),
            'author' => $post->user->name ?? 'Admin',
            'cover' => $post->getFirstMediaUrl('default'),
        ];

        return Inertia::render('Post/Show', [
            'post' => $postData,
        ]);
    }
}