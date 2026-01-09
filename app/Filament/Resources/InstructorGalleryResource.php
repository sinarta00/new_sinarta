<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorGalleryResource\Pages;
use App\Models\InstructorGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class InstructorGalleryResource extends Resource
{
    protected static ?string $model = InstructorGallery::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery Hero';
    protected static ?string $modelLabel = 'Foto Gallery';
    protected static ?string $pluralModelLabel = 'Gallery Hero';
    protected static ?string $navigationGroup = 'Instruktur';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Upload Foto')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('instructor-gallery')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '3:4',
                                '2:3',
                            ])
                            ->maxSize(5120)
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Upload foto portrait/vertikal. Ukuran maksimal 5MB. Rekomendasi ratio 3:4 atau 2:3'),
                        
                        Forms\Components\TextInput::make('alt_text')
                            ->label('Deskripsi Foto')
                            ->placeholder('contoh: Instruktur K3 sedang mengajar')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil angka, semakin awal ditampilkan')
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Preview')
                    ->disk('public')
                    ->height(80)
                    ->width(60),
                
                Tables\Columns\TextColumn::make('alt_text')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(50)
                    ->default('—'),
                
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (InstructorGallery $record) {
                        if ($record->image_path && Storage::disk('public')->exists($record->image_path)) {
                            Storage::disk('public')->delete($record->image_path);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->image_path && Storage::disk('public')->exists($record->image_path)) {
                                    Storage::disk('public')->delete($record->image_path);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstructorGalleries::route('/'),
            'create' => Pages\CreateInstructorGallery::route('/create'),
            'edit' => Pages\EditInstructorGallery::route('/{record}/edit'),
        ];
    }
}