<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Berita & Artikel';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),
                                
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(Post::class, 'slug', ignoreRecord: true),

                                Forms\Components\RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('posts/content'),
                            ]),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                                    ->collection('default')
                                    ->image()
                                    ->imageEditor(),
                            ]),
                            
                        Forms\Components\Section::make('Publikasi')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                    
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->default(now()),
                                    
                                // Hidden field untuk user_id
                                Forms\Components\Hidden::make('user_id')
                                    ->default(fn () => auth()->id()),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover'),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                    
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                    ]),
                    
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}