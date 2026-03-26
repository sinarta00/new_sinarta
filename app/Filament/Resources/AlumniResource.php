<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;

    protected static ?string $navigationIcon  = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Alumni';
    protected static ?string $modelLabel      = 'Alumni';
    protected static ?string $pluralModelLabel = 'Data Alumni';
    protected static ?string $navigationGroup = 'Manajemen Alumni';
    protected static ?int    $navigationSort  = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Diri Alumni')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')->required()->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')->email()->nullable()->maxLength(255),

                    Forms\Components\TextInput::make('phone')
                        ->label('Nomor HP')->tel()->required()->maxLength(20),

                    Forms\Components\Select::make('training_id')
                        ->label('Pelatihan')
                        ->required()
                        ->relationship('training', 'training_name')
                        ->getOptionLabelFromRecordUsing(
                            fn (Training $record) =>
                                "{$record->training_name} — Angkatan {$record->batch} ({$record->training_year}) · {$record->organizer}"
                        )
                        ->searchable()->preload()->native(false),

                    Forms\Components\Toggle::make('is_working')
                        ->label('Sudah Bekerja?')
                        ->default(false)
                        ->onColor('success')
                        ->offColor('gray'),
                    
                    Forms\Components\TextInput::make('company_name')
                        ->label('Nama Perusahaan')
                        ->nullable()
                        ->maxLength(255)
                        ->visible(fn (Forms\Get $get) => (bool) $get('is_working')),

                    Forms\Components\TextInput::make('job_position')
                        ->label('Posisi / Jabatan')
                        ->nullable()
                        ->maxLength(255)
                        ->visible(fn (Forms\Get $get) => (bool) $get('is_working')),

                    Forms\Components\Toggle::make('has_skp')
                        ->label('Punya SKP?')
                        ->default(false)
                        ->onColor('success')
                        ->offColor('gray')
                        ->live(),

                    Forms\Components\DatePicker::make('skp_expired_date')
                        ->label('Tanggal Expired SKP')
                        ->nullable()
                        ->displayFormat('d M Y')
                        ->visible(fn (Forms\Get $get) => (bool) $get('has_skp'))
                        ->requiredIf('has_skp', true),

                    Forms\Components\FileUpload::make('work_photo')
                        ->label('Foto Sedang Bekerja')
                        ->image()
                        ->nullable()
                        ->disk('public')
                        ->directory('alumni/photos')
                        ->acceptedFileTypes(['image/jpeg', 'image/png'])
                        ->maxSize(5120)
                        ->imagePreviewHeight('200')
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('allow_publish_photo')
                        ->label('Bersedia Foto Dipublikasikan di Sosial Media?')
                        ->default(false)
                        ->onColor('success')
                        ->offColor('gray')
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()->sortable()->weight('semibold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()->placeholder('—')->copyable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor HP')
                    ->searchable()->copyable()
                    ->icon('heroicon-m-phone'),

                Tables\Columns\TextColumn::make('training.training_name')
                    ->label('Nama Pelatihan')
                    ->searchable()->sortable()->wrap(),

                Tables\Columns\TextColumn::make('training.batch')
                    ->label('Angkatan')
                    ->badge()->color('info')->sortable(),

                Tables\Columns\TextColumn::make('training.training_year')
                    ->label('Tahun')->sortable(),

                Tables\Columns\TextColumn::make('training.organizer')
                    ->label('Penyelenggara')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'BNSP'     => 'success',
                        'Kemnaker' => 'warning',
                        default    => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_working')
                    ->label('Bekerja?')
                    ->boolean()
                    ->trueIcon('heroicon-o-briefcase')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\IconColumn::make('has_skp')
                    ->label('Punya SKP?')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('skp_expired_date')
                    ->label('Expired SKP')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable()
                    ->color(fn ($record) => $record?->skp_expired_date?->isPast() ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('company_name')
                    ->label('Perusahaan')
                    ->searchable()
                    ->placeholder('—')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('job_position')
                    ->label('Posisi')
                    ->searchable()
                    ->placeholder('—')
                    ->toggleable(),

                Tables\Columns\ImageColumn::make('work_photo')
                    ->label('Foto Kerja')
                    ->disk('public')
                    ->height(48)
                    ->width(48)
                    ->circular()
                    ->defaultImageUrl(fn () => null)
                    ->toggleable(),

                Tables\Columns\IconColumn::make('allow_publish_photo')
                    ->label('Izin Publish')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')->dateTime('d M Y, H:i')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
              Tables\Filters\SelectFilter::make('training_id')
                ->label('Pelatihan')
                ->options(
                    Training::orderBy('training_year', 'desc')
                        ->orderBy('training_name')
                        ->get()
                        ->mapWithKeys(fn (Training $training) => [
                            $training->id => "{$training->training_name} — Angkatan {$training->batch} ({$training->training_year})"
                        ])
                )
                ->searchable(),

                Tables\Filters\SelectFilter::make('organizer')
                    ->label('Penyelenggara')
                    ->options(['BNSP' => 'BNSP', 'Kemnaker' => 'Kemnaker', 'Lainnya' => 'Lainnya'])
                    ->query(function (Builder $query, array $data) {
                        if (! empty($data['value'])) {
                            $query->whereHas('training', fn ($q) => $q->where('organizer', $data['value']));
                        }
                    }),

                Tables\Filters\Filter::make('has_email')
                    ->label('Hanya yang Punya Email')
                    ->query(fn (Builder $q) => $q->whereNotNull('email')),

                Tables\Filters\TernaryFilter::make('is_working')
                    ->label('Status Bekerja')
                    ->trueLabel('Sudah Bekerja')
                    ->falseLabel('Belum Bekerja')
                    ->placeholder('Semua'),

                Tables\Filters\TernaryFilter::make('has_skp')
                    ->label('Status SKP')
                    ->trueLabel('Punya SKP')
                    ->falseLabel('Belum Punya SKP')
                    ->placeholder('Semua'),

                Tables\Filters\Filter::make('skp_expired')
                    ->label('SKP Sudah Expired')
                    ->query(fn (Builder $q) => $q->where('has_skp', true)->whereDate('skp_expired_date', '<', now())),

                Tables\Filters\TernaryFilter::make('allow_publish_photo')
                    ->label('Izin Publish Foto')
                    ->trueLabel('Bersedia Dipublikasi')
                    ->falseLabel('Tidak Bersedia')
                    ->placeholder('Semua'),

                Tables\Filters\Filter::make('has_photo')
                    ->label('Hanya yang Upload Foto')
                    ->query(fn (Builder $q) => $q->whereNotNull('work_photo')),
            ])
            ->actions([
                  Tables\Actions\Action::make('download_photo')
                    ->label('Download Foto')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (Alumni $record) => $record->work_photo !== null)
                    ->url(fn (Alumni $record) => asset('storage/' . $record->work_photo))
                    ->openUrlInNewTab(),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data alumni')
            ->emptyStateDescription('Data alumni akan muncul setelah alumni mengisi formulir.')
            ->emptyStateIcon('heroicon-o-users');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAlumni::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'view'   => Pages\ViewAlumni::route('/{record}'),
            'edit'   => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
