<?php

namespace App\Filament\Resources\GeneralReviews;

use App\Filament\Resources\GeneralReviews\Pages\CreateGeneralReview;
use App\Filament\Resources\GeneralReviews\Pages\EditGeneralReview;
use App\Filament\Resources\GeneralReviews\Pages\ListGeneralReviews;
use App\Filament\Resources\GeneralReviews\Schemas\GeneralReviewForm;
use App\Filament\Resources\GeneralReviews\Tables\GeneralReviewsTable;
use App\Models\GeneralReview;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GeneralReviewResource extends Resource
{
    protected static ?string $model = GeneralReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftEllipsis;

    protected static string|\UnitEnum|null $navigationGroup = 'Ulasan Pelanggan';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GeneralReviewForm::configure($schema)->components([
            TextInput::make('name')
                ->label('Nama Customer')
                ->required()
                ->maxLength(255),
            Textarea::make('review')
                ->label('Isi Review')
                ->required()
                ->columnSpanFull(),
            Toggle::make('is_highlighted')
                ->label('Tampilkan di Beranda (Highlight)'),
            Toggle::make('is_approved')
                ->label('Tampilkan ke Publik')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return GeneralReviewsTable::configure($table)->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('review')
                    ->label('Review')
                    ->limit(50),
                IconColumn::make('is_highlighted')
                    ->label('Highlight')
                    ->boolean(),
                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGeneralReviews::route('/'),
            'create' => CreateGeneralReview::route('/create'),
            'edit' => EditGeneralReview::route('/{record}/edit'),
        ];
    }
}
