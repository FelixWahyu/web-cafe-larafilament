<?php

namespace App\Filament\Resources\GeneralReviews\Pages;

use App\Filament\Resources\GeneralReviews\GeneralReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGeneralReviews extends ListRecords
{
    protected static string $resource = GeneralReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
