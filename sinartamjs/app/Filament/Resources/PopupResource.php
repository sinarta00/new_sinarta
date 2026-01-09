<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopupResource\Pages;
use App\Models\Popup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PopupResource extends Resource
{
    protected static ?string $model = Popup::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Popup Promo';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Popup')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Popup')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi (Opsional)')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Deskripsi singkat tentang promo/info'),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Popup')
                            ->image()
                            ->directory('popups')
                            ->required()
                            ->maxSize(2048)
                            ->helperText('Ukuran optimal: 600x800px (portrait) atau 800x600px (landscape)')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Link & Aksi')
                    ->schema([
                        Forms\Components\TextInput::make('link')
                            ->label('Link Tujuan (Opsional)')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Link ketika popup diklik, kosongkan jika tidak perlu')
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('open_new_tab')
                            ->label('Buka di Tab Baru')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Link akan dibuka di tab baru'),
                    ]),
                
                Forms\Components\Section::make('Jadwal Tampil')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->helperText('Popup mulai ditampilkan dari tanggal ini (kosongkan untuk langsung aktif)'),
                        
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Berakhir')
                            ->helperText('Popup berhenti ditampilkan setelah tanggal ini (kosongkan untuk tidak ada batas)'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Pengaturan Tampilan')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),
                        
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Prioritas')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Semakin kecil angka, semakin prioritas untuk ditampilkan'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('Prioritas')
                    ->sortable(),
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('-'),
                
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
            'index' => Pages\ListPopups::route('/'),
            'create' => Pages\CreatePopup::route('/create'),
            'edit' => Pages\EditPopup::route('/{record}/edit'),
        ];
    }
}