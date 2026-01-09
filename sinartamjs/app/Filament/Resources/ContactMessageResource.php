<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $navigationGroup = 'Messages';
    protected static ?int $navigationSort = 1;

    // Badge untuk unread messages
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::unread()->count() > 0 ? 'danger' : 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->disabled()
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('program')
                            ->label('Program Diminati')
                            ->disabled()
                            ->placeholder('Tidak disebutkan'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Isi Pesan')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Catatan Admin')
                    ->schema([
                        Forms\Components\Toggle::make('is_read')
                            ->label('Sudah Dibaca')
                            ->inline(false),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Internal')
                            ->rows(3)
                            ->placeholder('Tambahkan catatan untuk follow up...')
                            ->columnSpanFull(),
                        
                        Forms\Components\Placeholder::make('read_at')
                            ->label('Dibaca Pada')
                            ->content(fn ($record) => $record?->read_at ? $record->read_at->format('d M Y, H:i') : '-'),
                        
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Diterima Pada')
                            ->content(fn ($record) => $record?->created_at->format('d M Y, H:i')),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-m-envelope'),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-phone'),
                
                Tables\Columns\TextColumn::make('program')
                    ->label('Program')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => $state ?: 'Belum dipilih')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->created_at->diffForHumans()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_read')
                    ->label('Status')
                    ->options([
                        '0' => 'Belum Dibaca',
                        '1' => 'Sudah Dibaca',
                    ]),
                
                Tables\Filters\SelectFilter::make('program')
                    ->label('Program')
                    ->options([
                        'ak3' => 'AK3 Umum',
                        'bnsp' => 'BNSP',
                        'skp' => 'SKP',
                        'tot' => 'TOT',
                        'other' => 'Lainnya',
                    ]),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('markAsRead')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-envelope-open')
                    ->color('success')
                    ->hidden(fn ($record) => $record->is_read)
                    ->action(function ($record) {
                        $record->markAsRead();
                        
                        Notification::make()
                            ->title('Pesan ditandai sebagai sudah dibaca')
                            ->success()
                            ->send();
                    }),
                
                Tables\Actions\Action::make('markAsUnread')
                    ->label('Tandai Belum Dibaca')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->hidden(fn ($record) => !$record->is_read)
                    ->action(function ($record) {
                        $record->markAsUnread();
                        
                        Notification::make()
                            ->title('Pesan ditandai sebagai belum dibaca')
                            ->success()
                            ->send();
                    }),
                
                Tables\Actions\ViewAction::make(),
                
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Tandai Dibaca')
                        ->icon('heroicon-o-envelope-open')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->markAsRead();
                            
                            Notification::make()
                                ->title('Pesan berhasil ditandai sebagai sudah dibaca')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('markAsUnread')
                        ->label('Tandai Belum Dibaca')
                        ->icon('heroicon-o-envelope')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each->markAsUnread();
                            
                            Notification::make()
                                ->title('Pesan berhasil ditandai sebagai belum dibaca')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto refresh setiap 30 detik
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}