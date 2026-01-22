<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorApplicationResource\Pages;
use App\Models\InstructorApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Support\Facades\Storage;

class InstructorApplicationResource extends Resource
{
    protected static ?string $model = InstructorApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Instruktur';
    
    protected static ?string $modelLabel = 'Pendaftar Instruktur';
    
    protected static ?string $pluralModelLabel = 'Pendaftar Instruktur';
    
    protected static ?string $navigationGroup = 'Instruktur';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->disabled(),
                        Forms\Components\TextInput::make('city')
                            ->label('Kota')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status & Catatan Admin')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pribadi')
                    ->schema([
                        TextEntry::make('full_name')->label('Nama Lengkap'),
                        TextEntry::make('email')->label('Email')->copyable(),
                        TextEntry::make('whatsapp')->label('WhatsApp')->copyable(),
                        TextEntry::make('city')->label('Kota'),
                    ])->columns(2),

                Section::make('Bidang Keahlian')
                    ->schema([
                        TextEntry::make('expertise_fields')
                            ->label('Bidang Keahlian')
                            ->badge()
                            ->separator(','),
                        TextEntry::make('other_expertise')
                            ->label('Topik Lainnya')
                            ->visible(fn ($record) => !empty($record->other_expertise)),
                    ]),

                Section::make('Dokumen')
                    ->schema([
                        TextEntry::make('cv_path')
                            ->label('CV')
                            ->formatStateUsing(fn () => 'Download CV')
                            ->url(fn ($record) => $record->cv_path ? Storage::url($record->cv_path) : null)
                            ->openUrlInNewTab()
                            ->color('primary'),
                        TextEntry::make('diploma_file')
                            ->label('Ijazah')
                            ->formatStateUsing(fn () => 'Download Ijazah')
                            ->url(fn ($record) => $record->diploma_file ? Storage::url($record->diploma_file) : null)
                            ->openUrlInNewTab()
                            ->color('primary'),
                        TextEntry::make('certificate_paths')
                            ->label('Sertifikat')
                            ->listWithLineBreaks()
                            ->formatStateUsing(fn ($state, $record) => collect($record->certificate_paths)->map(function ($path, $index) {
                                return '<a href="' . Storage::url($path) . '" target="_blank" class="text-primary-600 hover:underline">Sertifikat ' . ($index + 1) . '</a>';
                            })->join('<br>'))
                            ->html(),
                    ])->columns(2),

                Section::make('Kesediaan')
                    ->schema([
                        TextEntry::make('availability_time')
                            ->label('Waktu')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match($state) {
                                'weekday' => 'Weekday',
                                'weekend' => 'Weekend',
                                default => $state,
                            }),
                        TextEntry::make('availability_programs')
                            ->label('Program')
                            ->listWithLineBreaks()
                            ->bulleted(),
                    ])->columns(2),

                Section::make('Motivasi')
                    ->schema([
                        TextEntry::make('motivation')
                            ->label('Mengapa Tertarik')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Admin')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                default => $state,
                            }),
                        TextEntry::make('admin_notes')->label('Catatan Admin'),
                    ])->columns(2),

                Section::make('Tracking')
                    ->schema([
                        TextEntry::make('created_at')->label('Tanggal Daftar')->dateTime('d F Y H:i'),
                        TextEntry::make('ip_address')->label('IP Address'),
                    ])->columns(2)->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstructorApplications::route('/'),
            'view' => Pages\ViewInstructorApplication::route('/{record}'),
            'edit' => Pages\EditInstructorApplication::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}