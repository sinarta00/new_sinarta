<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Key/Kunci')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Contoh: site_name, phone, email, address')
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('type')
                            ->label('Tipe Data')
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'image' => 'Image',
                                'url' => 'URL',
                            ])
                            ->required()
                            ->reactive(),
                        
                        Forms\Components\Textarea::make('value')
                            ->label('Nilai')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                    Forms\Components\Section::make('Pengaturan')
                ->schema([
                    Forms\Components\TextInput::make('key')
                        ->label('Key/Kunci')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Contoh: site_name, phone, email, address')
                        ->maxLength(255),
                    
                    Forms\Components\Select::make('type')
                        ->label('Tipe Data')
                        ->options([
                            'text' => 'Text',
                            'textarea' => 'Textarea',
                            'image' => 'Image',
                            'url' => 'URL',
                            'boolean' => 'Boolean (On/Off)',
                        ])
                        ->required()
                        ->reactive(),
                    
                    Forms\Components\Textarea::make('value')
                        ->label('Nilai')
                        ->rows(5)
                        ->columnSpanFull()
                        ->visible(fn ($get) => $get('type') !== 'boolean'),
                    
                    Forms\Components\Toggle::make('value')
                        ->label('Nilai')
                        ->visible(fn ($get) => $get('type') === 'boolean')
                        ->formatStateUsing(fn ($state) => $state === '1' || $state === 'true' || $state === true)
                        ->dehydrateStateUsing(fn ($state) => $state ? '1' : '0'),
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Key')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'url' => 'URL',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}