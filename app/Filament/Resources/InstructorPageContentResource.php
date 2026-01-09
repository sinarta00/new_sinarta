<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorPageContentResource\Pages;
use App\Models\InstructorPageContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InstructorPageContentResource extends Resource
{
    protected static ?string $model = InstructorPageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Kelola Halaman';
    
    protected static ?string $modelLabel = 'Konten Halaman';
    
    protected static ?string $navigationGroup = 'Instruktur';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('section_key')
                    ->label('Section Key')
                    ->required()
                    ->disabled()
                    ->helperText('Tidak bisa diubah'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                Forms\Components\Section::make('Konten')
                    ->schema(function ($record) {
                        if (!$record) {
                            return [
                                Forms\Components\Placeholder::make('info')
                                    ->content('Pilih section untuk mengedit konten')
                            ];
                        }

                        return match ($record->section_key) {
                            'hero' => [
                                Forms\Components\TextInput::make('content.title')
                                    ->label('Title')
                                    ->required(),
                                Forms\Components\Textarea::make('content.subtitle')
                                    ->label('Subtitle')
                                    ->rows(2)
                                    ->required(),
                                Forms\Components\Textarea::make('content.description')
                                    ->label('Description')
                                    ->rows(4)
                                    ->required(),
                            ],
                            'programs' => [
                                Forms\Components\Repeater::make('content')
                                    ->label('Program Cards')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Nama Program')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->rows(2)
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->collapsible()
                                    ->addActionLabel('Tambah Program')
                                    ->defaultItems(0)
                                    ->minItems(1)
                            ],
                            'requirements' => [
                                Forms\Components\Repeater::make('content')
                                    ->label('Persyaratan')
                                    ->simple(
                                        Forms\Components\TextInput::make('requirement')
                                            ->label('Persyaratan')
                                            ->required()
                                    )
                                    ->addActionLabel('Tambah Persyaratan')
                                    ->defaultItems(0)
                            ],
                            'benefits' => [
                                Forms\Components\Repeater::make('content')
                                    ->label('Benefits')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul Benefit')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->rows(3)
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->collapsible()
                                    ->addActionLabel('Tambah Benefit')
                                    ->defaultItems(0)
                            ],
                            'contact' => [
                                Forms\Components\TextInput::make('content.help_text')
                                    ->label('Help Text')
                                    ->required(),
                                Forms\Components\TextInput::make('content.whatsapp')
                                    ->label('WhatsApp Number')
                                    ->tel()
                                    ->required(),
                                Forms\Components\TextInput::make('content.contact_name')
                                    ->label('Contact Name')
                                    ->required(),
                            ],
                            default => [
                                Forms\Components\Placeholder::make('info')
                                    ->content('Section ini belum memiliki form kustom')
                            ],
                        };
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_key')
                    ->label('Section')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', $state))),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            ])
            ->defaultSort('section_key', 'asc')
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstructorPageContents::route('/'),
            'edit' => Pages\EditInstructorPageContent::route('/{record}/edit'),
        ];
    }
}