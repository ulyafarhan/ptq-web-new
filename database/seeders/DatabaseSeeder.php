<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@ptq.com',
            'password' => Hash::make('admin123'),
        ]);

        User::factory(5)->create();

        \App\Models\Structure::factory()->create([
            'name' => 'Setia Wanda',
            'position' => 'Ketua Umum',
            'group_type' => 'teras',
            'level' => 1,
            'sort_order' => 1,
        ]);

        \App\Models\Structure::factory()->create([
            'name' => 'Wahid',
            'position' => 'Wakil Ketua Umum',
            'group_type' => 'teras',
            'level' => 1,
            'sort_order' => 1,
        ]);

        \App\Models\Structure::factory()->create([
            'name' => 'Ripan',
            'position' => 'Sekretaris Umum',
            'group_type' => 'teras',
            'level' => 1,
            'sort_order' => 1,
        ]);

        \App\Models\Structure::factory()->create([
            'name' => 'Yasmin',
            'position' => 'Bendahara Umum',
            'group_type' => 'teras',
            'level' => 1,
            'sort_order' => 1,
        ]);

        $divisions = [
            'Divisi Infokom',
            'Divisi Pelatihan',
            'Divisi Kewirausahaan',
            'Divisi Agama',
            'Divisi Kesekretariatan',
            'Divisi Humas',
        ];

        foreach ($divisions as $index => $division) {
            \App\Models\Structure::factory()->create([
                'name' => 'Kepala ' . $division,
                'position' => 'Kepala Divisi',
                'group_type' => 'division',
                'division_name' => $division,
                'level' => 2,
                'sort_order' => $index + 1,
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            \App\Models\Post::factory()->create([
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            \App\Models\Post::factory()->create([
                'user_id' => $admin->id,
                'status' => 'draft',
            ]);
        }

        \App\Models\Post::factory(20)->create([
            'user_id' => $admin->id,
            'status' => 'published',
        ]);

        \App\Models\Post::factory(5)->create([
            'user_id' => $admin->id,
            'status' => 'draft',
        ]);

        $programs = [
            ['title' => 'Tahsin & Tahfidz', 'type' => 'rutin', 'schedule' => 'Senin & Rabu, 16.00-17.30', 'location' => 'Masjid PTQ'],
            ['title' => 'Kajian Hadits', 'type' => 'rutin', 'schedule' => 'Selasa, 16.00-17.30', 'location' => 'Masjid PTQ'],
            ['title' => 'Kajian Fiqih', 'type' => 'rutin', 'schedule' => 'Kamis, 16.00-17.30', 'location' => 'Masjid PTQ'],
            ['title' => 'Khataman Al-Quran', 'type' => 'bulanan', 'schedule' => 'Jumat Pekan ke-4', 'location' => 'Masjid PTQ'],
            ['title' => 'Pelatihan Manajemen Dakwah', 'type' => 'tahunan', 'status' => 'Coming Soon'],
            ['title' => 'Dauroh Al-Quran', 'type' => 'tahunan', 'status' => 'Selesai'],
        ];

        foreach ($programs as $program) {
            \App\Models\Program::factory()->create($program);
        }

        $milestones = [
            ['year' => '2010', 'title' => 'Pendirian PTQ', 'description' => 'Pusat Tahfidz Quran (PTQ) didirikan oleh Dr. KH. Ahmad Lutfi Fathullah, MA.'],
            ['year' => '2012', 'title' => 'Program Tahfidz Pertama', 'description' => 'Meluncurkan program tahfidz angkatan pertama dengan 20 santri.'],
            ['year' => '2015', 'title' => 'Pembangunan Masjid', 'description' => 'Pembangunan masjid PTQ sebagai pusat kegiatan ibadah dan belajar.'],
            ['year' => '2018', 'title' => 'Kerjasama Internasional', 'description' => 'Menjalin kerjasama dengan lembaga tahfidz di Timur Tengah.'],
            ['year' => '2022', 'title' => 'Program Digitalisasi', 'description' => 'Meluncurkan platform pembelajaran Al-Quran online.'],
        ];

        foreach ($milestones as $milestone) {
            \App\Models\Milestone::factory()->create($milestone);
        }

        $settings = [
            ['key' => 'site_title', 'value' => 'UKM PTQ', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Mencetak Generasi Qurani, Berakhlak Mulia, dan Bermanfaat untuk Umat.', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'info@ptq.com', 'type' => 'text'],
            ['key' => 'address', 'value' => 'Jl. Pendidikan No. 1, Jakarta', 'type' => 'text'],
            ['key' => 'phone_number', 'value' => '0812-3456-7890', 'type' => 'text'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/ptq', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/ptq', 'type' => 'text'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/ptq', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::factory()->create($setting);
        }
    }
}