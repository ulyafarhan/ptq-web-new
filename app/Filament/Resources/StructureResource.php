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
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
                    ->description('Informasi biodata pengurus.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->label('Nama Lengkap')
                            ->regex('/^[a-zA-Z\s\.\,\'\-]+$/') 
                            ->validationMessages([
                                'regex' => 'Nama hanya boleh mengandung huruf, titik, koma, strip, dan petik satu.',
                            ]),
                        
                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan Visual')
                            ->placeholder('Contoh: Ketua Umum')
                            ->required()
                            ->maxLength(100)
                            ->regex('/^[a-zA-Z0-9\s\-\(\)\.]+$/'),

                        SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('default')
                            ->label('Foto Profil')
                            ->image()
                            ->imageEditor()
                            ->directory('structures')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->rules(['mimes:jpeg,png,webp'])
                            ->preserveFilenames(false)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan Posisi & Hierarki')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('group_type')
                                    ->label('Tipe Kelompok')
                                    ->options([
                                        'teras' => 'Pengurus Teras (Inti)',
                                        'division' => 'Divisi / Departemen',
                                    ])
                                    ->default('division')
                                    ->live() 
                                    ->required()
                                    ->native(false),

                                Forms\Components\TextInput::make('division_name')
                                    ->label('Nama Divisi')
                                    ->placeholder('Contoh: Divisi Humas')
                                    ->visible(fn (Get $get) => $get('group_type') === 'division')
                                    ->required(fn (Get $get) => $get('group_type') === 'division')
                                    ->maxLength(100)
                                    ->regex('/^[a-zA-Z0-9\s\-\&]+$/'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('level')
                                    ->label('Level Hierarki')
                                    ->helperText('Level 1 (Ketua) akan tampil paling atas.')
                                    ->options([
                                        1 => 'Level 1 - Ketua / Pimpinan',
                                        2 => 'Level 2 - Sekretaris / Bendahara',
                                        3 => 'Level 3 - Koordinator Divisi',
                                        4 => 'Level 4 - Anggota Staff',
                                    ])
                                    ->default(4)
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Urutan Prioritas')
                                    ->minValue(0)
                                    ->maxValue(999),
                                    
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
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('group_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'teras' => 'warning', 
                        'division' => 'success', 
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'teras' => 'Inti',
                        'division' => 'Divisi',
                        default => $state,
                    })
                    ->label('Tipe'),

                Tables\Columns\TextColumn::make('division_name')
                    ->label('Divisi')
                    ->placeholder('-')
                    ->limit(20),
                    
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
                
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
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
            'index' => Pages\ListStructures::route('/'),
            'create' => Pages\CreateStructure::route('/create'),
            'edit' => Pages\EditStructure::route('/{record}/edit'),
        ];
    }
}