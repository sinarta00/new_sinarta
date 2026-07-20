<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\ProgramResource\RelationManagers\SchedulesRelationManager;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Program Pelatihan';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 3;

    protected static function generateFileName(TemporaryUploadedFile $file): string {
        $filename = Str::slug(
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
        );

        return now()->format('YmdHis')
            . '_' . $filename
            . '_' . Str::lower(Str::random(4))
            . '.' 
            . $file->getClientOriginalExtension();
    }

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
                            ->label('Benefit')
                            ->helperText('Setiap baris akan menjadi 1 poin benefit')
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\components\Textarea::make('requirements')
                            ->label('Persyaratan')
                            ->helperText('Setiap baris akan menjadi 1 poin persyaratan')
                            ->rows(5)
                            ->columnSpanFull(),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Program')
                            ->image()
                            ->disk('public')
                            ->directory('programs')
                            ->getUploadedFileNameForStorageUsing(function ($file) {
                               fn (TemporaryUploadedFile $file) => self::generateFileName($file);
                            })
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('benefit_image')
                            ->label('Gambar Benefit')
                            ->image()
                            ->disk('public')
                            ->directory('programs/benefit-images')
                             ->getUploadedFileNameForStorageUsing(function ($file) {
                                fn (TemporaryUploadedFile $file) => self::generateFileName($file);
                            })
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        
                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('Proposal (PDF)')
                             ->acceptedFileTypes(['application/pdf'])
                            ->directory('program-pdfs')
                            ->getUploadedFileNameForStorageUsing(function ($file) {
                               fn (TemporaryUploadedFile $file) => self::generateFileName($file);
                            })
                            ->maxSize(15000) // 5MB
                            ->downloadable()
                            ->previewable(false)
                            ->nullable(),

                        Forms\Components\FileUpload::make('registration_flow_image')
                            ->label('Foto alur registrasi')
                            ->image()
                            ->directory('programs/registration-flow')
                            ->imageEditor()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpg', 'image/png', 'image/webp'])
                            ->nullable()
                    ]),

                    Forms\Components\Section::make('Harga & Varian')
                        ->description('Tambahkan 1 varian saja jika program tidak berjenis (kosongkan kolom Tipe)')
                        ->schema([
                            Forms\Components\Repeater::make('variants')
                                ->relationship('variants')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Tipe Varian')
                                        ->placeholder('Personal / Utusan Perusahaan / Online / Offline')
                                        ->helperText('Kosongkan jika program hanya 1 harga')
                                        ->nullable(),

                                    Forms\Components\TextInput::make('price')
                                        ->label('Harga (Rp)')
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->required(),

                                    Forms\Components\TextInput::make('discount')
                                        ->label('Diskon')
                                        ->numeric()
                                        ->suffix('%')
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('duration')
                                        ->label('Durasi')
                                        ->placeholder('Contoh: 12 Hari')
                                        ->helperText('Kosongkan jika sama dengan durasi program')
                                        ->nullable(),

                                    Forms\Components\TextInput::make('registration_link')
                                        ->label('Link Pendaftaran')
                                        ->url()
                                        ->placeholder('https://wa.me/...')
                                        ->nullable()
                                        ->columnSpanFull(),

                                    Forms\Components\Toggle::make('is_active')
                                        ->label('Aktif')
                                        ->default(true),
                                ])
                                ->columns(2)
                                ->orderColumn('order')
                                ->addActionLabel('+ Tambah Varian')
                                ->defaultItems(1)        // otomatis 1 baris saat create baru
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
                    ->label('Gambar')
                    ->disk('public')
                    ->height(50),
                
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
                
                Tables\Columns\TextColumn::make('price_range')
                    ->label('Harga')
                    ->getStateUsing(fn ($record) => $record->price_range)
                    ->sortable(false),

                Tables\Columns\TextColumn::make('variants_count')
                    ->counts('variants')
                    ->label('Varian')
                    ->badge()
                    ->color('info'),

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

    public static function getRelations(): array
{
    return [
        SchedulesRelationManager::class,
    ];
}
}