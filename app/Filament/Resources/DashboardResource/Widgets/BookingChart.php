<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Booking per Bulan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Booking::selectRaw('MONTH(booking_date) as month, COUNT(*) as total')
        ->whereYear('booking_date', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = [];
    $counts = [];

    foreach ($data as $item) {
        $months[] = Carbon::create()->month($item->month)->locale('id')->monthName;
        $counts[] = $item->total;
    }

    return [
        'datasets' => [
            [
                'label' => 'Jumlah Booking',
                'data' => $counts,
                'backgroundColor' => '#3b82f6',
            ],
        ],
        'labels' => $months,
    ];

    }

    protected function getType(): string
    {
        return 'bar';
    }
}
