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
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profil Pengurus')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan Visual')
                            ->placeholder('Misal: Ketua Umum atau Staff Humas')
                            ->required(),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('default')
                            ->image()
                            ->imageEditor()
                            ->directory('structures'),
                    ])->columns(2),

                Forms\Components\Section::make('Logika Hierarki')
                    ->description('Tentukan posisi dalam diagram organisasi')
                    ->schema([
                        // LOGIC SELECTOR
                        Forms\Components\Select::make('group_type')
                            ->options([
                                'teras' => 'Pengurus Teras (Inti)',
                                'division' => 'Divisi / Departemen',
                            ])
                            ->default('division')
                            ->live() // PENTING: Agar form refresh saat ini berubah
                            ->required(),

                        // MUNCUL HANYA JIKA DIVISI
                        Forms\Components\TextInput::make('division_name')
                            ->label('Nama Divisi')
                            ->placeholder('Misal: Divisi Humas')
                            ->hidden(fn (Get $get) => $get('group_type') !== 'division')
                            ->required(fn (Get $get) => $get('group_type') === 'division'),

                        Forms\Components\Select::make('level')
                            ->label('Tingkatan')
                            ->options([
                                1 => 'Ketua / Koordinator',
                                2 => 'Sekretaris / Bendahara',
                                3 => 'Anggota Staff',
                            ])
                            ->default(3)
                            ->required(),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Urutan Prioritas (Angka Kecil di Atas)'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Status Aktif'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('group_type')
                    ->colors([
                        'warning' => 'teras',
                        'success' => 'division',
                    ]),
                Tables\Columns\TextColumn::make('division_name')
                    ->label('Divisi')
                    ->placeholder('-'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('group_type')
                    ->options([
                        'teras' => 'Teras',
                        'division' => 'Divisi',
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