<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\{DatePicker, Select, TextInput};
use Filament\Tables\Columns\{TextColumn, BadgeColumn};
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Bookings';
    protected static ?string $navigationGroup = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_user')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Select::make('id_vehicle')
                ->label('Vehicle')
                ->relationship('vehicle', 'vehicle_name')
                ->searchable()
                ->required(),

                Select::make('id_driver')
                ->label('Driver')
                ->relationship('driver', 'name')
                ->searchable()
                ->nullable(), // <- ini membuatnya opsional
            

            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->required(),
            DatePicker::make('booking_date')->required(),

            Select::make('payment_status')
                ->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                    'expired' => 'Expired',
                ])
                ->default('pending')
                ->required(),

            Select::make('booking_status')
                ->options([
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('ongoing')
                ->required(),

            TextInput::make('phone_security')->required(),
            TextInput::make('phone_person')->required(),
            TextInput::make('nik_identity')->required(),
            TextInput::make('booking_price')->numeric()->required(),
            FileUpload::make('identity')
            ->label('Upload Identity')
            ->image()
            ->directory('images/identity')
            ->acceptedFileTypes(['image/png', 'image/jpeg'])
            ->previewable()
            ->required(),


        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->searchable()->sortable(),
                TextColumn::make('vehicle.vehicle_name')->label('Vehicle')->searchable()->sortable(),
                TextColumn::make('driver.name')->label('Driver')->sortable()->toggleable(),
                TextColumn::make('start_date')->date(),
                TextColumn::make('end_date')->date(),
                BadgeColumn::make('payment_status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'gray' => 'expired',
                    ])
                    ->sortable(),

                BadgeColumn::make('booking_status')
                    ->colors([
                        'info' => 'ongoing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),
                TextColumn::make('booking_price')->money('IDR'),
                TextColumn::make('booking_price')->money('IDR'),
                TextColumn::make('booking_date')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                    'expired' => 'Expired',
                ]),
                Tables\Filters\SelectFilter::make('booking_status')->options([
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
