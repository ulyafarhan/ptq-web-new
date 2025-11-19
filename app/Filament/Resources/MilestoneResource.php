<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MilestoneResource\Pages;
use App\Models\Milestone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MilestoneResource extends Resource
{
    protected static ?string $model = Milestone::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock'; 
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $modelLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah';
    protected static ?string $navigationLabel = 'Sejarah';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun')
                            ->required()
                            ->numeric()
                            ->placeholder('2010')
                            ->maxLength(4),
                            
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Peristiwa')
                            ->required()
                            ->placeholder('Pendirian UKM / Juara Nasional')
                            ->maxLength(255),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Lengkap')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                            
                        // Field sort_order disembunyikan karena diurus otomatis oleh tabel
                        Forms\Components\Hidden::make('sort_order')
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order') // FITUR UTAMA: Drag & Drop Sorting
            ->defaultSort('sort_order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),
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
            'index' => Pages\ListMilestones::route('/'),
            'create' => Pages\CreateMilestone::route('/create'),
            'edit' => Pages\EditMilestone::route('/{record}/edit'),
        ];
    }
}