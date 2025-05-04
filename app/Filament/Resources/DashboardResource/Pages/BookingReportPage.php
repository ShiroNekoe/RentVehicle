<?php

namespace App\Filament\Resources\DashboardResource\Pages;

use App\Models\Booking;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DashboardResource;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Tables\Filters\Filter;


class BookingReportPage extends Page
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationLabel = 'Laporan Booking';
    protected static string $view = 'filament.pages.booking-report-page';

    protected function getTableQuery(): Builder
    {
        return Booking::with('vehicle', 'user', 'driver');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('booking_date')->label('Tanggal Booking')->date(),
            TextColumn::make('vehicle.vehicle_name')->label('Kendaraan'),
            TextColumn::make('user.name')->label('Penyewa'),
            TextColumn::make('booking_price')->label('Harga')->money('IDR', true),
            TextColumn::make('payment_status')->badge()->color(fn (string $state): string => match ($state) {
                'pending' => 'warning',
                'paid' => 'success',
                'failed' => 'danger',
                'expired' => 'gray',
            }),
            TextColumn::make('booking_status')->badge()->color(fn (string $state): string => match ($state) {
                'ongoing' => 'info',
                'completed' => 'success',
                'cancelled' => 'danger',
            }),
        ];
    }
    protected function getTableFilters(): array
    {
        return [
            Filter::make('booking_date')
                ->form([
                    \Filament\Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                    \Filament\Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['from'], fn ($q) => $q->whereDate('booking_date', '>=', $data['from']))
                        ->when($data['until'], fn ($q) => $q->whereDate('booking_date', '<=', $data['until']));
                }),
        ];
    }
    
    protected function getTableHeaderActions(): array
    {
        return [
            FilamentExportHeaderAction::make('export')
                ->label('Ekspor')
                ->exportOptions([
                    'pdf', 'xlsx', 'csv',
                ])
                ->fileName(fn () => 'Laporan_Booking_' . now()->format('Y-m-d_H-i')),
        ];
    }
    
    protected function getTableBulkActions(): array
    {
        return [
            FilamentExportBulkAction::make('exportBulk')
                ->label('Ekspor yang dipilih'),
        ];
    }
}
