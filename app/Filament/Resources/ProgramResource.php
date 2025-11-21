<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days'; 
    protected static ?string $navigationLabel = 'Program Kerja';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $modelLabel = 'Program Kerja';
    protected static ?string $pluralModelLabel = 'Program Kerja';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Kegiatan')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Nama Program')
                                    ->required()
                                    ->maxLength(150)
                                    ->regex('/^[a-zA-Z0-9\s\-\.\,\'\(\)\&]+$/')
                                    ->validationMessages([
                                        'regex' => 'Judul mengandung karakter terlarang (html tags tidak diizinkan).',
                                    ]),
                                
                                Forms\Components\Select::make('type')
                                    ->label('Jenis Kegiatan')
                                    ->options([
                                        'rutin' => 'Rutin (Mingguan)',
                                        'bulanan' => 'Bulanan / Berkala',
                                        'tahunan' => 'Event Besar Tahunan',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->live(),
                                    
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3)
                                    ->maxLength(500) 
                                    ->regex('/^[^<>]*$/') 
                                    ->validationMessages([
                                        'regex' => 'Deskripsi tidak boleh mengandung tag HTML (< >).',
                                    ])
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Detail Pelaksanaan')
                            ->schema([
                                Forms\Components\TextInput::make('schedule')
                                    ->label('Jadwal Waktu')
                                    ->placeholder('Contoh: Senin, 16.00 WIB')
                                    ->maxLength(100)
                                    ->regex('/^[a-zA-Z0-9\s\-\.\,\:]+$/') 
                                    ->validationMessages([
                                        'regex' => 'Jadwal mengandung karakter terlarang (html tags tidak diizinkan).',
                                    ]),
                                
                                Forms\Components\TextInput::make('location')
                                    ->label('Lokasi')
                                    ->placeholder('Contoh: Masjid Kampus')
                                    ->maxLength(100)
                                    ->regex('/^[a-zA-Z0-9\s\-\.\,]+$/'),
                                    
                                Forms\Components\TextInput::make('status')
                                    ->label('Status Event')
                                    ->placeholder('Status saat ini')
                                    ->visible(fn (Get $get) => $get('type') === 'tahunan')
                                    ->maxLength(50)
                                    ->regex('/^[a-zA-Z0-9\s]+$/') 
                                    ->validationMessages([
                                        'regex' => 'Status mengandung karakter terlarang (html tags tidak diizinkan).',
                                    ]),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Media & Status')
                            ->schema([
                                
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Gambar / Poster')
                                    ->collection('default')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(5120) 
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->rules(['mimes:jpeg,png,webp']) 
                                    ->directory('programs/posters')
                                    ->preserveFilenames(false), 
                                    
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Tampilkan di Website')
                                    ->default(true)
                                    ->inline(false),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('default')
                    ->label('Poster')
                    ->height(60)
                    ->circular(), 
                    
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->label('Program')
                    ->wrap(),
                    
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'success' => 'rutin',
                        'warning' => 'bulanan',
                        'danger' => 'tahunan',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->label('Tipe'),
                    
                Tables\Columns\TextColumn::make('schedule')
                    ->label('Jadwal')
                    ->limit(25)
                    ->icon('heroicon-m-clock'),
                    
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'rutin' => 'Rutin',
                        'bulanan' => 'Bulanan',
                        'tahunan' => 'Tahunan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}