<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleReturnResource\Pages;
use App\Filament\Resources\VehicleReturnResource\RelationManagers;
use App\Models\VehicleReturn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{Select, DatePicker, Textarea};
use Filament\Tables\Columns\{TextColumn, BadgeColumn};

class VehicleReturnResource extends Resource
{
    protected static ?string $model = VehicleReturn::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-down';
    protected static ?string $navigationLabel = 'Vehicle Returns';
    protected static ?string $navigationGroup = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('booking_id')
                    ->label('Booking')
                    ->relationship('booking', 'id')
                    ->searchable()
                    ->required(),

                DatePicker::make('return_date')
                    ->label('Return Date')
                    ->required(),

                Select::make('status')
                    ->options([
                        'on_time' => 'On Time',
                        'late' => 'Late',
                        'damaged' => 'Damaged',
                    ])
                    ->default('on_time')
                    ->required(),

                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(4)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.id')->label('Booking ID')->sortable(),
                TextColumn::make('return_date')->date()->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'on_time',
                        'warning' => 'late',
                        'danger' => 'damaged',
                    ])
                    ->sortable(),
                TextColumn::make('notes')->limit(50)->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'on_time' => 'On Time',
                    'late' => 'Late',
                    'damaged' => 'Damaged',
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
            'index' => Pages\ListVehicleReturns::route('/'),
            'create' => Pages\CreateVehicleReturn::route('/create'),
            'edit' => Pages\EditVehicleReturn::route('/{record}/edit'),
        ];
    }
}
