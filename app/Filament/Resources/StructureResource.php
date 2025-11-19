<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StructureResource\Pages;
use App\Models\Structure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;

class StructureResource extends Resource
{
    protected static ?string $model = Structure::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Pengurus';
    protected static ?string $modelLabel = 'Pengurus';
    protected static ?string $pluralModelLabel = 'Struktur UKM';
    protected static ?string $navigationGroup = 'Profil UKM';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profil Pengurus')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Lengkap'),
                            
                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan Visual')
                            ->placeholder('Contoh: Ketua Umum / Staff Humas')
                            ->required(),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('default') // Default collection Spatie
                            ->image()
                            ->imageEditor() // Fitur crop
                            ->directory('structures') // Folder di storage
                            ->maxSize(2048), // Max 2MB
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan Posisi (Logika)')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                // LOGIC SELECTOR
                                Forms\Components\Select::make('group_type')
                                    ->label('Tipe Kelompok')
                                    ->options([
                                        'teras' => 'Pengurus Teras (Inti)',
                                        'division' => 'Divisi / Departemen',
                                    ])
                                    ->default('division')
                                    ->live() // PENTING: Agar form bereaksi live
                                    ->required(),

                                // MUNCUL HANYA JIKA DIVISI
                                Forms\Components\TextInput::make('division_name')
                                    ->label('Nama Divisi')
                                    ->placeholder('Contoh: Divisi Humas')
                                    ->hidden(fn (Forms\Get $get) => $get('group_type') !== 'division')
                                    ->required(fn (Forms\Get $get) => $get('group_type') === 'division')
                                    ->columnSpan(1),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('level')
                                    ->label('Hierarki Jabatan')
                                    ->options([
                                        1 => 'Ketua / Koordinator (Top)',
                                        2 => 'Sekretaris / Bendahara (Mid)',
                                        3 => 'Anggota Staff (Low)',
                                    ])
                                    ->default(3)
                                    ->required(),
                                    
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Urutan Prioritas')
                                    ->helperText('Angka lebih kecil tampil lebih dulu'),
                                    
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true)
                                    ->label('Aktifkan Profil')
                                    ->inline(false),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order') 
            ->defaultSort('sort_order', 'asc')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->collection('default')
                    ->circular()
                    ->label('Foto'),
                    
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold')
                    ->label('Nama'),
                    
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('group_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'teras' => 'warning', 
                        'division' => 'success', 
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->label('Tipe'),

                Tables\Columns\TextColumn::make('division_name')
                    ->label('Divisi')
                    ->placeholder('-'), 
                    
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group_type')
                    ->options([
                        'teras' => 'Pengurus Teras',
                        'division' => 'Divisi',
                    ])
                    ->label('Filter Tipe'),
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
            'index' => Pages\ListStructures::route('/'),
            'create' => Pages\CreateStructure::route('/create'),
            'edit' => Pages\EditStructure::route('/{record}/edit'),
        ];
    }
}