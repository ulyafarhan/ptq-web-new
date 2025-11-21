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
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PostResource extends Resource
{
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Data Berita';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
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
                                    ->maxLength(255)
                                    ->regex('/^[a-zA-Z0-9\s\-\.\,\?\!\:\(\)\'\"\&\/]+$/') 
                                    ->validationMessages([
                                        'regex' => 'Judul mengandung karakter ilegal (< > { } tidak diizinkan).',
                                    ])
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),
                                
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Post::class, 'slug', ignoreRecord: true),

                                Forms\Components\RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull()
                                    ->label('Konten Berita')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'strike', 'link', 'bulletList', 'orderedList', 
                                        'h2', 'h3', 'blockquote', 'undo', 'redo', 'attachFiles'
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('posts/content')
                                    ->fileAttachmentsVisibility('public'),
                            ]),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Media')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('cover')
                                    ->collection('default')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(5120) // 5MB
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->rules(['mimes:jpeg,png,webp']) 
                                    ->directory('posts/covers')
                                    ->preserveFilenames(false), 
                            ]),
                        
                        Forms\Components\Section::make('Publikasi')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('draft')
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->default(now()),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('default')
                    ->height(50)
                    ->label('Cover'),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40)
                    ->description(fn (Post $record): string => $record->slug)
                    ->label('Judul'),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'gray',
                    })
                    ->label('Status'),
                
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->label('Tanggal Tayang'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}