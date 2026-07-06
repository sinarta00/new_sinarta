<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int    $navigationSort  = 10;

    // -------------------------------------------------------
    // FORM
    // -------------------------------------------------------
    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Informasi Foto')
                ->columns(2)
                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('category')
                        ->label('Kategori')
                        ->placeholder('cth: Pelatihan, Sertifikasi, Kegiatan')
                        ->maxLength(100),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka lebih kecil tampil lebih dulu'),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Tampilkan di Website')
                        ->default(true)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Upload Foto')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Foto')
                        ->image()
                        ->required()
                        ->directory('gallery')          
                        ->disk('public')
                        ->imageEditor()                 
                        ->imageEditorAspectRatios([     
                            '16:9',
                            '4:3', 
                            '1:1',
                            null,                       
                        ])
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth('1280')
                        ->imageResizeTargetHeight('720')
                        ->maxSize(5120)                 
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format: JPG, PNG, WebP. Maks 5 MB.')
                        ->deleteUploadedFileUsing(function ($file) {
                            Storage::disk('public')->delete($file);
                        }),
                ]),
        ]);
    }

    // -------------------------------------------------------
    // TABLE
    // -------------------------------------------------------
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public')
                    ->height(60)
                    ->width(90)
                    ->extraImgAttributes(['class' => 'rounded object-cover']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(fn () =>
                        Gallery::query()
                            ->whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray()
                    ),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif saja')
                    ->falseLabel('Nonaktif saja'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function (Gallery $record) {
                        // Hapus file fisik saat record dihapus
                        Storage::disk('public')->delete($record->image_path);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function ($records) {
                            foreach ($records as $record) {
                                Storage::disk('public')->delete($record->image_path);
                            }
                        }),
                ]),
            ])
            ->reorderable('sort_order'); // drag-and-drop untuk ubah urutan
    }

    // -------------------------------------------------------
    // PAGES
    // -------------------------------------------------------
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit'   => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}