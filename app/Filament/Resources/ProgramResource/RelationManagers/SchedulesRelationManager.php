<?php

// Taruh di: app/Filament/Resources/ProgramResource/RelationManagers/SchedulesRelationManager.php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SchedulesRelationManager extends RelationManager
{
    protected static string $relationship = 'schedules';
    protected static ?string $title = 'Jadwal Pelatihan';

   public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->native(false),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->native(false)
                    ->afterOrEqual('start_date'),
            ]),

            Forms\Components\Section::make('Tanggal Ujian')
                ->description('Isi sesuai jenis program. Kemnaker: Seminar & Teori. BNSP: Assesment.')
                ->schema([
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\DatePicker::make('exam_date_seminar')
                            ->label('Ujian Seminar')
                            ->native(false)
                            ->nullable(),

                        Forms\Components\DatePicker::make('exam_date_teori')
                            ->label('Ujian Teori')
                            ->native(false)
                            ->nullable(),

                        Forms\Components\DatePicker::make('exam_date_assesment')
                            ->label('Assesment')
                            ->native(false)
                            ->nullable(),
                    ]),
                ])
                ->collapsible(),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('city')
                    ->label('Kota')
                    ->required(),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi / Gedung')
                    ->placeholder('cth: Hotel Mercure Balikpapan'),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('quota')
                    ->label('Kuota Peserta')
                    ->numeric()
                    ->default(20)
                    ->required(),

                Forms\Components\TextInput::make('registered')
                    ->label('Sudah Daftar')
                    ->numeric()
                    ->default(0),
            ]),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('exam_date_seminar')
                    ->label('Ujian Seminar')
                    ->date('d M Y')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('exam_date_teori')
                    ->label('Ujian Teori')
                    ->date('d M Y')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('exam_date_assesment')
                    ->label('Assesment BNSP')
                    ->date('d M Y')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota'),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('registered')
                    ->label('Peserta')
                    ->formatStateUsing(fn ($record) => "{$record->registered} / {$record->quota}"),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn ($record) => $record->status)
                    ->colors([
                        'success' => 'Tersedia',
                        'warning' => 'Penuh',
                    ]),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('+ Tambah Jadwal'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('start_date', 'asc');
    }
}