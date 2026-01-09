<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Program Pelatihan';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Program')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Nama Program')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'KEMNAKER' => 'Kemnaker',
                                'BNSP' => 'BNSP',
                                'SKP' => 'SKP',
                                'TOT' => 'TOT',
                                'OTHER' => 'Lainnya',
                            ])
                            ->required(),
                        
                        Forms\Components\TextInput::make('duration')
                            ->label('Durasi')
                            ->helperText('Contoh: 12 Hari, 3-5 Hari')
                            ->maxLength(255),
                        
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Program')
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('features')
                            ->label('Fitur/Materi (pisahkan dengan enter)')
                            ->helperText('Setiap baris akan menjadi 1 poin fitur')
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Program')
                            ->image()
                            ->directory('programs')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Harga & Kuota')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Kosongkan jika tidak ingin menampilkan harga'),
                    ]),

                Forms\Components\Section::make('Link Pendaftaran')
                    ->schema([
                        Forms\Components\TextInput::make('registration_link')
                            ->label('Link Pendaftaran')
                            ->url()
                            ->placeholder('https://wa.me/6281234567890 atau https://forms.gle/xxxxx')
                            ->helperText('Link untuk tombol "Daftar". Kosongkan untuk menggunakan WhatsApp default.')
                            ->maxLength(500)
                            ->columnSpanFull(),
                ]),
                
                Forms\Components\Section::make('Pengaturan Tampilan')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),
                        
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Program')
                    ->searchable()
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'KEMNAKER' => 'success',
                        'BNSP' => 'info',
                        'SKP' => 'warning',
                        'TOT' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi'),
                
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\IconColumn::make('registration_link')
                    ->label('Link Daftar')
                    ->boolean()
                    ->trueIcon('heroicon-o-link')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),
                
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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'KEMNAKER' => 'Kemnaker',
                        'BNSP' => 'BNSP',
                        'SKP' => 'SKP',
                        'TOT' => 'TOT',
                        'OTHER' => 'Lainnya',
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
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}