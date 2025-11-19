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

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days'; // Icon Kalender
    protected static ?string $navigationLabel = 'Program Kerja';
    protected static ?string $navigationGroup = 'Manajemen Konten';
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
                                    ->maxLength(255),
                                
                                Forms\Components\Select::make('type')
                                    ->label('Jenis Kegiatan')
                                    ->options([
                                        'rutin' => 'Rutin (Mingguan)',
                                        'bulanan' => 'Bulanan / Berkala',
                                        'tahunan' => 'Event Besar Tahunan',
                                    ])
                                    ->required()
                                    ->live(), // Agar form bisa bereaksi (munculkan status)
                                    
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Detail Pelaksanaan')
                            ->schema([
                                Forms\Components\TextInput::make('schedule')
                                    ->label('Jadwal Waktu')
                                    ->placeholder('Contoh: Senin, 16.00 WIB atau Setiap Pekan ke-2'),
                                
                                Forms\Components\TextInput::make('location')
                                    ->label('Lokasi')
                                    ->placeholder('Contoh: Masjid Kampus / Aula'),
                                    
                                // Input Status HANYA MUNCUL jika tipe = Tahunan
                                Forms\Components\TextInput::make('status')
                                    ->label('Status Event')
                                    ->placeholder('Contoh: Coming Soon, Selesai, Open Recruitment')
                                    ->visible(fn (Get $get) => $get('type') === 'tahunan'),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Media & Status')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Gambar / Poster')
                                    ->collection('default')
                                    ->image()
                                    ->imageEditor(),
                                    
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
                    ->label('Poster'),
                    
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->label('Program'),
                    
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
                    ->limit(20),
                    
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