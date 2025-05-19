<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;


class BookingStatusPie extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Status Booking';

    protected function getData(): array
    {
        $data = Booking::selectRaw('booking_status, COUNT(*) as total')
            ->groupBy('booking_status')
            ->pluck('total', 'booking_status');

        return [
            'datasets' => [
                [
                    'label' => 'Status Booking',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => ['#10b981', '#ef4444','#3b82f6' ]
                ],
            ],
            'labels' => $data->keys()->map(fn ($key) => ucfirst($key))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
