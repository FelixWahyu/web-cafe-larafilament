<?php

namespace App\Filament\Resources\GeneralReviews\Pages;

use App\Filament\Resources\GeneralReviews\GeneralReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGeneralReview extends EditRecord
{
    protected static string $resource = GeneralReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
