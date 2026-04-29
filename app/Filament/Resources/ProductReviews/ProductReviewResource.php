<?php

namespace App\Filament\Resources\ProductReviews;

use App\Filament\Resources\ProductReviews\Pages\CreateProductReview;
use App\Filament\Resources\ProductReviews\Pages\EditProductReview;
use App\Filament\Resources\ProductReviews\Pages\ListProductReviews;
use App\Filament\Resources\ProductReviews\Schemas\ProductReviewForm;
use App\Filament\Resources\ProductReviews\Tables\ProductReviewsTable;
use App\Models\ProductReview;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductReviewResource extends Resource
{
    protected static ?string $model = ProductReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Star;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductReviewForm::configure($schema)->components([
            Select::make('product_id')
                ->label('Produk')
                ->relationship('product', 'name')
                ->required(),
            TextInput::make('name')
                ->label('Nama Reviewer')
                ->required()
                ->default('Guest')
                ->maxLength(255),
            TextInput::make('rating')
                ->label('Rating (1-5)')
                ->required()
                ->numeric()
                ->minValue(1)
                ->maxValue(5),
            Textarea::make('review')
                ->label('Komentar')
                ->columnSpanFull(),
            Toggle::make('is_approved')
                ->label('Tampilkan ke Publik')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ProductReviewsTable::configure($table)->columns([
            TextColumn::make('product.name')
                ->label('Produk')
                ->sortable()
                ->searchable(),
            TextColumn::make('name')
                ->label('Reviewer')
                ->searchable(),
            TextColumn::make('rating')
                ->label('Rating')
                ->sortable(),
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
            'index' => ListProductReviews::route('/'),
            'create' => CreateProductReview::route('/create'),
            'edit' => EditProductReview::route('/{record}/edit'),
        ];
    }
}
