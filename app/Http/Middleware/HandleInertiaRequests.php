<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting; 
use Illuminate\Http\Request;
use Inertia\Middleware;

use function Laravel\Prompts\warning;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],

            'site' => [
                'hero_title' => $settings['hero_title'] ?? 'UKM PTQ Unimal',
                'register_url' => $settings['register_url'] ?? null,
                'contact' => [
                    'email' => $settings['contact_email'] ?? 'ukmptq@unimal.ac.id',
                    'address' => $settings['contact_address'] ?? 'Sekretariat UKM PTQ, Universitas Malikussaleh',
                    'instagram' => $settings['social_instagram'] ?? '#',
                    'tiktok' => $settings['social_tiktok'] ?? '#',
                    'youtube' => $settings['social_youtube'] ?? '#',
                    'whatsapp' => $settings['social_whatsapp'] ?? '#',
                ]
            ],
            'menus' => [
                    ['name' => 'Beranda', 'url' => '/'],
                    ['name' => 'Profil', 'url' => '/profil'],
                    ['name' => 'Program', 'url' => '/program-kerja'],
                    ['name' => 'Berita', 'url' => '/berita'],
                ]
        ]);
    }
}