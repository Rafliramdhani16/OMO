<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Shirt;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ShirtResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ShirtResource\RelationManagers;

class ShirtResource extends Resource
{
    protected static ?string $model = Shirt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->required(),
                            Forms\Components\Repeater::make('photos')
                            ->relationship('photos')

                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->required(),
                            ]),
                        Forms\Components\Repeater::make('sizes')
                            ->relationship('sizes')
                            ->schema([
                                Forms\Components\TextInput::make('size')
                                    ->required(),
                            ]),
                    ]),

                    Fieldset::make('Additional')
                    ->schema([
                        Forms\Components\TextArea::make('about')
                            ->required(),
                        Forms\Components\Select::make('is_popular')
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular',
                            ])
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->prefix('Qty'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category_name'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\IconColumn::make('is_popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Popular'),
            ])
            ->filters([
                //
                SelectFilter::make('category_id')
                ->label('category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListShirts::route('/'),
            'create' => Pages\CreateShirt::route('/create'),
            'edit' => Pages\EditShirt::route('/{record}/edit'),
        ];
    }
}
