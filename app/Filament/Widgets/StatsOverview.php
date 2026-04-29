<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\GeneralReview;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Menu Produk', Product::count())
                ->description('Seluruh menu yang tersedia')
                ->icon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('Kategori Menu', Category::count())
                ->description('Kategori yang aktif')
                ->icon('heroicon-o-tag')
                ->color('info'),

            Stat::make('Total Ulasan Kafe', GeneralReview::count())
                ->description('Ulasan dari pelanggan')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('warning'),
        ];
    }
}
