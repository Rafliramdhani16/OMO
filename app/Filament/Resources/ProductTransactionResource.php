<?php

namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Tables;
use App\Models\Shirt;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\ProductTransaction;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductTransactionResource\Pages;
use App\Filament\Resources\ProductTransactionResource\RelationManagers;
use App\Models\PromoCode;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;

class ProductTransactionResource extends Resource
{
    protected static ?string $model = ProductTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('shirt_id')
                                        ->relationship('shirt', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->reactive()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $shirt = Shirt::find($state);
                                            $price = $shirt ? $shirt->price : 0;
                                            $quantity = $get('quantity') ?? 1;
                                            $subTotalAmount = $price * $quantity;
                                            
                                            $set('price', $price);
                                            $set('sub_total_amount', $subTotalAmount);
                
                                            $discount = $get('discount_amount') ?? 0;
                                            $grandTotalAmount = $subTotalAmount - $discount;
                                            $set('grand_total_amount', $grandTotalAmount);
                
                                            $sizes = $shirt ? $shirt->sizes->pluck('size', 'id')->toArray() : [];
                                            $set('shirt_sizes', $sizes);
                                        }),

                                    Forms\Components\Select::make('shirt_size')
                                        ->label('Shirt Size')
                                        ->options(function (callable $get) {
                                            $sizes = $get('shirt_sizes');
                                            return is_array($sizes) ? $sizes : [];
                                        })
                                        ->required()
                                        ->reactive(),

                                    Forms\Components\TextInput::make('quantity')
                                        ->required()
                                        ->numeric()
                                        ->prefix('Qty')
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $price = $get('price');
                                            $quantity = $state;
                                            $subTotalAmount = $price * $quantity;
                                            
                                            $set('sub_total_amount', $subTotalAmount);
                                            
                                            $discount = $get('discount_amount') ?? 0;
                                            $grandTotalAmount = $subTotalAmount - $discount;
                                            $set('grand_total_amount', $grandTotalAmount);
                                        }),

                                    Forms\Components\Select::make('promo_code_id')
                                        ->relationship('promoCode', 'code')
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $subTotalAmount = $get('sub_total_amount');
                                            $promoCode = PromoCode::find($state);
                                            $discount = $promoCode ? $promoCode->discount_amount : 0;

                                            $set('discount_amount', $discount);

                                            $grandTotalAmount = $subTotalAmount - $discount;
                                            $set('grand_total_amount', $grandTotalAmount);
                                        }),

                                    Forms\Components\TextInput::make('sub_total_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),
                                        
                                    Forms\Components\TextInput::make('discount_amount')
                                        ->required()
                                        ->default(0)
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),

                                    Forms\Components\TextInput::make('grand_total_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),
                                ]),
                        ]),

                        Forms\Components\Wizard\Step::make('Customer Information')
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                ->required()
                                ->maxLength(15),

                                Forms\Components\TextInput::make('email')
                                ->required()
                                ->maxLength(255),

                                Forms\Components\TextArea::make('address')
                                ->rows(5)
                                ->maxLength(255),

                                Forms\Components\TextInput::make('city')
                                ->required()
                                ->maxLength(255),

                                Forms\Components\TextInput::make('post_code')
                                ->required()
                                ->maxLength(255),
                            ])
                        ]),

                        Forms\Components\Wizard\Step::make('Payment Information')
                        ->schema([
                            Forms\Components\TextInput::make('booking_trx_id')
                            ->required()
                            ->maxLength(255),

                            ToggleButtons::make('is_paid')
                            ->label('Apakah sudah membayar?')
                            ->boolean()
                            ->grouped()
                            ->icons([
                                true => 'heroicon-o-pencil',
                                false => 'heroicon-o-clock',
                            ])
                            ->required(),

                            Forms\Components\FileUpload::make('proof')
                            ->image()
                            ->required(),
                        ]),

                ])
                ->columnSpan('full')
                ->columns(1)
                ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                Tables\Columns\ImageColumn::make('shirt.thumbnail'),

                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('booking_trx_id')
                ->searchable(),

                Tables\Columns\IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Terverifikasi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->action(function(ProductTransaction $record){
                    $record->is_paid = true;
                    $record->save();

                    Notification::make()
                    ->title('Order Approved')
                    ->success()
                    ->body('The order has been successfully approved.')
                    ->send();
                })
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
            'index' => Pages\ListProductTransactions::route('/'),
            'create' => Pages\CreateProductTransaction::route('/create'),
            'edit' => Pages\EditProductTransaction::route('/{record}/edit'),
        ];
    }
}
