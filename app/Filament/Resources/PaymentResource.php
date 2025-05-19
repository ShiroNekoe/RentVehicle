<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\{Select, DatePicker, TextInput};
use Filament\Tables\Columns\{TextColumn, BadgeColumn};

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Payments';
    protected static ?string $navigationGroup = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_booking')
                    ->label('Booking')
                    ->relationship('booking', 'id')
                    ->searchable()
                    ->required(),

                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'expired' => 'Expired',
                    ])
                    ->required(),

                TextInput::make('payment_price')
                    ->label('Payment Amount')
                    ->numeric()
                    ->required(),

                Forms\Components\Card::make([
                FileUpload::make('proof')
                    ->image()
                    ->directory('proofs')
                    ->required(),
                     ]),


                DatePicker::make('payment_date')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.id')->label('Booking ID')->sortable(),
                BadgeColumn::make('payment_status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'gray' => 'expired',
                    ])
                    ->sortable(),
                TextColumn::make('payment_price')->money('IDR')->sortable(),
                TextColumn::make('transfer_to'),
            Tables\Columns\ImageColumn::make('proof')
                ->disk('public')
                ->label('Bukti Transfer'),
                TextColumn::make('payment_date')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                    'expired' => 'Expired',
                ]),
                
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
