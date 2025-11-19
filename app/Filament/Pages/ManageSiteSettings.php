<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 99;

    protected static string $view = 'filament.pages.manage-site-settings';

    // Property untuk menampung data form
    public ?array $data = [];

    // 1. Saat Halaman Dibuka (Mount)
    public function mount(): void
    {
        // Ambil semua setting dari DB dan jadikan array [key => value]
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        
        // Isi form dengan data tersebut
        $this->form->fill($settings);
    }

    // 2. Definisi Form
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([ // <--- PENTING: Gunakan method ->tabs([...])
                        
                        // TAB 1: HERO SECTION
                        Forms\Components\Tabs\Tab::make('Halaman Depan')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Forms\Components\TextInput::make('hero_title')
                                    ->label('Judul Utama (Hero Title)')
                                    ->helperText('Teks besar di halaman awal website.')
                                    ->required(),
                                    
                                Forms\Components\Textarea::make('hero_desc')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3),
                            ]),

                        // TAB 2: PENDAFTARAN
                        Forms\Components\Tabs\Tab::make('Pendaftaran')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                Forms\Components\TextInput::make('register_url')
                                    ->label('Link Pendaftaran Eksternal (Opsional)')
                                    ->placeholder('https://forms.google.com/...')
                                    ->helperText('Kosongkan jika ingin menggunakan pendaftaran internal website.')
                                    ->url(),
                            ]),

                        // TAB 3: KONTAK
                        Forms\Components\Tabs\Tab::make('Kontak & Footer')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email Resmi')
                                    ->email(),
                                    
                                Forms\Components\TextInput::make('contact_address')
                                    ->label('Alamat Sekretariat'),
                                    
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('social_instagram')
                                            ->label('Link Instagram')
                                            ->prefix('instagram.com/'),
                                        
                                        Forms\Components\TextInput::make('social_whatsapp')
                                            ->label('Link Whatsapp')
                                            ->prefix('wa.me/'),
                                        
                                        Forms\Components\TextInput::make('social_youtube')
                                            ->label('Link Youtube')
                                            ->prefix('youtube.com/'),  
                                        
                                        Forms\Components\TextInput::make('social_tiktok')
                                            ->label('Link TikTok')
                                            ->prefix('tiktok.com/'),
                                    ])
                            ]),
                    ])
                    ->columnSpanFull(), // Agar Tabs melebar penuh
            ])
            ->statePath('data');
    }

    // 3. Action Simpan (Submit)
    public function save(): void
    {
        // Ambil data dari form
        $state = $this->form->getState();

        // Loop dan simpan ke database (Update or Create)
        foreach ($state as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],   // Cari berdasarkan key
                ['value' => $value] // Update valuenya
            );
        }

        // Tampilkan Notifikasi Sukses
        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
    
    // Definisi Tombol Action di Header Halaman (Opsional, biar ada tombol Save di atas juga)
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'), // Submit form 'save'
        ];
    }
}