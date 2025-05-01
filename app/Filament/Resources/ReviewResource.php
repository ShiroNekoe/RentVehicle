<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{DatePicker, Select};
use Filament\Tables\Columns\{TextColumn, BadgeColumn};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Reviews';
    protected static ?string $navigationGroup = 'Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_booking')
                ->label('Booking')
                ->relationship('booking', 'id')
                ->required()
                ->searchable(),

            Select::make('id_user')
                ->label('User')
                ->relationship('user', 'name')
                ->required()
                ->searchable(),

            Select::make('rating')
                ->label('Rating')
                ->options([
                    '1' => '⭐',
                    '2' => '⭐⭐',
                    '3' => '⭐⭐⭐',
                    '4' => '⭐⭐⭐⭐',
                    '5' => '⭐⭐⭐⭐⭐',
                ])
                ->required(),

            DatePicker::make('review_date')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.id')->label('Booking ID')->sortable(),
                TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                BadgeColumn::make('rating')
                    ->colors([
                        'danger' => '1',
                        'warning' => '2',
                        'warning' => '3',
                        'info' => '4',
                        'success' => '5',
                    ])
                    ->sortable(),
                TextColumn::make('review_date')->date()->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
