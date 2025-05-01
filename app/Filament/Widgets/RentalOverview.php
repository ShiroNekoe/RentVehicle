<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class RentalOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalBookings = Booking::count();

        $availableVehicles = Vehicle::where('status', 'available')->count();
        $maintenanceVehicles = Vehicle::where('status', 'maintenance')->count();
        $rentedVehicles = Vehicle::where('status', 'rented')->count();

        return [
            Card::make('Total Bookings', $totalBookings)
                ->description('Total penyewaan kendaraan')
                ->color('primary'),

            Card::make('Tersedia', $availableVehicles)
                ->description('Kendaraan siap disewa')
                ->color('success'),

            Card::make('Maintenance', $maintenanceVehicles)
                ->description('Sedang diperbaiki')
                ->color('warning'),

            Card::make('Disewa', $rentedVehicles)
                ->description('Sedang digunakan oleh penyewa')
                ->color('danger'),
        ];
    }
}
