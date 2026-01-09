<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Peserta')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('company')
                            ->label('Perusahaan')
                            ->maxLength(255),
                        
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('testimonials')
                            ->avatar()
                            ->maxSize(1024),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Testimoni')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Testimoni')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('rating')
                            ->label('Rating')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ (5 Bintang)',
                                4 => '⭐⭐⭐⭐ (4 Bintang)',
                                3 => '⭐⭐⭐ (3 Bintang)',
                                2 => '⭐⭐ (2 Bintang)',
                                1 => '⭐ (1 Bintang)',
                            ])
                            ->default(5)
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->inline(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('company')
                    ->label('Perusahaan')
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('content')
                    ->label('Testimoni')
                    ->limit(50)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        5 => '5 Bintang',
                        4 => '4 Bintang',
                        3 => '3 Bintang',
                        2 => '2 Bintang',
                        1 => '1 Bintang',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}