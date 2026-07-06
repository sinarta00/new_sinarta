<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationalStructureResource\Pages;
use App\Filament\Resources\OrganizationalStructureResource\RelationManagers;
use App\Models\OrganizationalStructure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class OrganizationalStructureResource extends Resource
{
    protected static ?string $model = OrganizationalStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                     ->label('Foto')
                        ->image()
                        ->required()
                        ->directory('gallery')          // disimpan di storage/app/public/gallery
                        ->disk('public')
                        ->imageEditor()                    // aktifkan editor crop/resize
                        ->imageEditorAspectRatios([        // opsional: batasi rasio crop
                            '16:9',
                            '4:3', 
                            '1:1',
                            null,                          // biarkan bebas juga
                        ])
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth('1280')
                        ->imageResizeTargetHeight('720')
                        ->maxSize(5120)                 // 5 MB
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format: JPG, PNG, WebP. Maks 5 MB.')
                        ->deleteUploadedFileUsing(function ($file) {
                            Storage::disk('public')->delete($file);
                        }),

                Forms\Components\Select::make('parent_id')
                    ->label('Atasan')
                    ->options(function (?OrganizationalStructure $record) {
                        $query = OrganizationalStructure::query();

                        if ($record) {
                            $query->where('id', '!=', $record->id);
                        }

                        return $query->pluck('position', 'id');
                        })
                    ->searchable()
                    ->helperText('Kosongkan jika ini posisi paling atas (mis. Direktur Utama)'),     

                    Forms\Components\TextInput::make('order')
                        ->label('Urutan tampil')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('position')->searchable(),
                Tables\Columns\TextColumn::make('parent.name')->label('Atasan')->placeholder('— Top level —'),
                Tables\Columns\TextColumn::make('order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])->defaultSort('order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizationalStructures::route('/'),
            'create' => Pages\CreateOrganizationalStructure::route('/create'),
            'edit' => Pages\EditOrganizationalStructure::route('/{record}/edit'),
        ];
    }    
}
