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
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->icon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('Kategori Menu', Category::count())
                ->description('Kategori yang aktif')
                ->descriptionIcon('heroicon-m-tag')
                ->chart([15, 4, 10, 2, 12, 4, 11])
                ->icon('heroicon-o-tag')
                ->color('info'),

            Stat::make('Total Ulasan Kafe', GeneralReview::count())
                ->description('Ulasan dari pelanggan')
                ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                ->chart([10, 12, 8, 14, 10, 16, 12])
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('warning'),
        ];
    }
}
