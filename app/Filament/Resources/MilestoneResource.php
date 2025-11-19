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
                Forms\Components\Section::make('Detail Peristiwa')
                    ->description('Masukkan data sejarah perusahaan dengan akurat.')
                    ->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun')
                            ->required()
                            ->numeric()
                            ->integer() 
                            ->length(4) 
                            ->minValue(1900) 
                            ->maxValue(date('Y') + 5) 
                            ->placeholder('2010')
                            ->columnSpan(1),
                            
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Peristiwa')
                            ->required()
                            ->placeholder('Contoh: Pendirian Perusahaan')
                            ->maxLength(150)
                            ->regex('/^[a-zA-Z0-9\s\-\,\.\(\)\&]+$/') 
                            ->validationMessages([
                                'regex' => 'Judul mengandung karakter terlarang (simbol html tidak diizinkan).',
                            ])
                            ->columnSpan(1),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Lengkap')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000) 
                            ->columnSpanFull(),
                            
                        Forms\Components\Hidden::make('sort_order')
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable()
                    ->badge() 
                    ->color('gray'),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(), 
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->color('gray')
                    ->wrap(),
            ])
            ->filters([
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
            'index' => Pages\ListMilestones::route('/'),
            'create' => Pages\CreateMilestone::route('/create'),
            'edit' => Pages\EditMilestone::route('/{record}/edit'),
        ];
    }
}