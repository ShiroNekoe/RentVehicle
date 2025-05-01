<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Config::$serverKey = env('SB-Mid-server-BiIsBuY89I1dJ2avP6pIeA93');
        Config::$isProduction = false; // true untuk production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
