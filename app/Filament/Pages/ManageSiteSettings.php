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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 99;

    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {

        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Halaman Depan')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Forms\Components\TextInput::make('hero_title')
                                    ->label('Judul Utama (Hero Title)')
                                    ->helperText('Teks besar di halaman awal website.')
                                    ->required()
                                    ->maxLength(100)
                                    ->regex('/^[a-zA-Z0-9\s\-\,\.\!\?]+$/')
                                    ->validationMessages([
                                        'regex' => 'Judul mengandung karakter terlarang (HTML tidak diizinkan).',
                                    ]),
                                
                                Forms\Components\Textarea::make('hero_desc')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->regex('/^[^<>]*$/'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Pendaftaran')
                            ->icon('heroicon-o-user-plus')
                            ->schema([
                                Forms\Components\TextInput::make('register_url')
                                    ->label('Link Pendaftaran Eksternal')
                                    ->placeholder('https://forms.google.com/...')
                                    ->helperText('Kosongkan jika ingin menggunakan pendaftaran internal website.')
                                    ->url() 
                                    ->maxLength(255)
                                    ->activeUrl(), 
                            ]),

                        Forms\Components\Tabs\Tab::make('Kontak & Footer')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email Resmi')
                                    ->email() 
                                    ->required()
                                    ->maxLength(100),
                                    
                                Forms\Components\TextInput::make('contact_address')
                                    ->label('Alamat Sekretariat')
                                    ->maxLength(255)
                                    ->regex('/^[a-zA-Z0-9\s\-\.\,\/\'\(\)]+$/'), 
                                    
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('social_instagram')
                                            ->label('Username Instagram')
                                            ->prefix('instagram.com/')
                                            ->placeholder('username_ptq')
                                            ->regex('/^@?[a-zA-Z0-9\.\_]+$/')
                                            ->helperText('Boleh pakai @ atau tidak.'),
                                            
                                        Forms\Components\TextInput::make('social_whatsapp')
                                            ->label('Nomor Whatsapp')
                                            ->prefix('wa.me/')
                                            ->placeholder('62812xxx')
                                            ->regex('/^[0-9\+]+$/'), 
                                            
                                        Forms\Components\TextInput::make('social_youtube')
                                            ->label('Channel Youtube')
                                            ->prefix('youtube.com/')
                                            ->regex('/^@?[a-zA-Z0-9\.\_\-]+$/'),
                                            
                                        Forms\Components\TextInput::make('social_tiktok')
                                            ->label('Username TikTok')
                                            ->prefix('tiktok.com/')
                                            ->regex('/^@?[a-zA-Z0-9\.\_\-]+$/'),
                                    ])
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $state = $this->form->getState();

            // SECURITY: Mencegah skrip injeksi
            DB::transaction(function () use ($state) {
                foreach ($state as $key => $value) {
                    $cleanValue = is_string($value) ? strip_tags($value) : $value;

                    SiteSetting::updateOrCreate(
                        ['key' => $key],   
                        ['value' => $cleanValue] 
                    );
                }
            });

            Notification::make()
                ->title('Pengaturan aman tersimpan')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan pengaturan')
                ->body('Terjadi kesalahan sistem: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-check-circle')
                ->action('save'),
        ];
    }
}