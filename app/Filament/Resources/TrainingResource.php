<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon  = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Data Pelatihan';
    protected static ?string $modelLabel      = 'Pelatihan';
    protected static ?string $pluralModelLabel = 'Data Pelatihan';
    protected static ?string $navigationGroup = 'Manajemen Alumni';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Pelatihan')
                ->schema([
                    Forms\Components\TextInput::make('training_name')
                        ->label('Nama Pelatihan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Pelatihan Teknik Pengelasan')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('batch')
                        ->label('Angkatan / Batch')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('Contoh: 1, 2, III'),

                    Forms\Components\TextInput::make('training_year')
                        ->label('Tahun Pelatihan')
                        ->required()
                        ->numeric()
                        ->minValue(2000)
                        ->maxValue(2100)
                        ->default((int) date('Y')),

                    Forms\Components\Select::make('organizer')
                        ->label('Penyelenggara')
                        ->required()
                        ->options([
                            'BNSP'     => 'BNSP (Badan Nasional Sertifikasi Profesi)',
                            'Kemnaker' => 'Kemnaker (Kementerian Ketenagakerjaan RI)',
                            'Lainnya'  => 'Lainnya',
                        ])
                        ->native(false),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('training_name')
                    ->label('Nama Pelatihan')
                    ->searchable()->sortable()->weight('semibold'),

                Tables\Columns\TextColumn::make('batch')
                    ->label('Angkatan')
                    ->badge()->color('info')->sortable(),

                Tables\Columns\TextColumn::make('training_year')
                    ->label('Tahun')->sortable(),

                Tables\Columns\TextColumn::make('organizer')
                    ->label('Penyelenggara')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'BNSP'     => 'success',
                        'Kemnaker' => 'warning',
                        default    => 'gray',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('alumni_count')
                    ->label('Jumlah Alumni')
                    ->counts('alumni')
                    ->badge()->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')->dateTime('d M Y')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('training_year', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('organizer')
                    ->label('Penyelenggara')
                    ->options(['BNSP' => 'BNSP', 'Kemnaker' => 'Kemnaker', 'Lainnya' => 'Lainnya']),

                Tables\Filters\SelectFilter::make('training_year')
                    ->label('Tahun')
                    ->options(
                        Training::query()->distinct()->orderBy('training_year', 'desc')
                            ->pluck('training_year', 'training_year')->toArray()
                    ),
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
            ->emptyStateHeading('Belum ada data pelatihan')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit'   => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
