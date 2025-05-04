<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class BookingReport extends BaseWidget
{
    protected function getCards(): array
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        return [
            Card::make('Total Booking Bulan Ini', Booking::whereBetween('booking_date', [$monthStart, $monthEnd])->count()),
            Card::make('Total Pendapatan Bulan Ini', 'Rp ' . number_format(
                Booking::where('payment_status', 'paid')
                       ->whereBetween('booking_date', [$monthStart, $monthEnd])
                       ->sum('booking_price'),
                0, ',', '.')
            ),
            Card::make('Booking Pending', Booking::where('payment_status', 'pending')->count()),
        ];
    }
}
