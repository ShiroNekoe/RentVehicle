<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Accommodation Setting';
    protected static ?string $label = 'Vehicle';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('vehicle_name')->required(),

                Select::make('vehicle_type')
                    ->options([
                        'car' => 'Car',
                        'motorcycles' => 'Motorcycles',
                    ])->required(),

                Select::make('vehicle_model')
                    ->options([
                        'big' => 'Big',
                        'medium' => 'Medium',
                        'small' => 'Small',
                    ])->required(),

                Select::make('vehicle_transmission')
                    ->options([
                        'matic' => 'Matic',
                        'manual' => 'Manual',
                    ])->required(),

                Select::make('vehicle_brand')
                    ->options([
                        'Honda' => 'Honda',
                        'Toyota' => 'Toyota',
                        'Daihatsu' => 'Daihatsu',
                        'Suzuki' => 'Suzuki',
                        'Mitsubishi' => 'Mitsubishi',
                        'Yamaha' => 'Yamaha',
                    ])->required(),

                TextInput::make('number_plate')->required(),


                Select::make('seat')
                ->options([
                    '2' => '2',
                    '5' => '5',
                    '8' => '8',
                    '12-20' => '12-20',
                    
                 
                ])->required(),

                TextInput::make('price')
                ->label('Price')
                ->required()
                ->numeric()
                ->prefix('Rp')
                ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2),

                Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'not available' => 'Not Available',
                        'maintenance' => 'Maintenance',
                        'in_used' => 'In Use',
                    ])->default('available')->required(),

                    Repeater::make('galleries') // sesuai dengan nama relasi di model Vehicle
                    ->relationship('galleries') // penting!
                    ->label('Upload Images')
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->directory('vehicles')
                            ->required(),
                    ])
                    ->grid(3)
                    ->addActionLabel('Add Image'),
                
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('vehicle_name')->searchable()->sortable(),
                TextColumn::make('vehicle_type')->sortable(),
                TextColumn::make('vehicle_model')->sortable(),
                TextColumn::make('vehicle_transmission')->sortable(),
                TextColumn::make('vehicle_brand')->sortable(),
                TextColumn::make('number_plate')->searchable(),
                TextColumn::make('seat')->sortable(),
                TextColumn::make('price')->money('IDR', true)->sortable(),
                TextColumn::make('vehicle_galleries')->formatStateUsing(fn ($record) => $record->galleries->count() . ' Images'),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'available' => 'success',
                        'not available' => 'danger',
                        'maintenance' => 'warning',
                        'in_used' => 'gray',
                    }),
                    
            ])
            ->filters([
                SelectFilter::make('vehicle_type')
                    ->options([
                        'car' => 'Car',
                        'motorcycles' => 'Motorcycles',
                    ]),
                SelectFilter::make('vehicle_model')
                    ->options([
                        'big' => 'Big',
                        'medium' => 'Medium',
                        'small' => 'Small',
                    ]),
                SelectFilter::make('vehicle_brand')
                    ->options([
                        'Honda' => 'Honda',
                        'Toyota' => 'Toyota',
                        'Daihatsu' => 'Daihatsu',
                        'Suzuki' => 'Suzuki',
                        'Mitsubishi' => 'Mitsubishi',
                        'Yamaha' => 'Yamaha',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'available' => 'Available',
                        'not available' => 'Not Available',
                        'maintenance' => 'Maintenance',
                        'in_used' => 'In Use',
                    ]),
            ])
            ->defaultSort('id', 'desc');

            
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
