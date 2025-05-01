<?php

namespace App\Filament\Resources\VehicleReturnResource\Pages;

use App\Filament\Resources\VehicleReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleReturn extends EditRecord
{
    protected static string $resource = VehicleReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
