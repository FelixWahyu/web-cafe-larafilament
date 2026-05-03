<?php

namespace App\Filament\Resources\PromoBanners;

use App\Filament\Resources\PromoBanners\Pages\CreatePromoBanner;
use App\Filament\Resources\PromoBanners\Pages\EditPromoBanner;
use App\Filament\Resources\PromoBanners\Pages\ListPromoBanners;
use App\Filament\Resources\PromoBanners\Schemas\PromoBannerForm;
use App\Filament\Resources\PromoBanners\Tables\PromoBannersTable;
use App\Models\PromoBanner;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PromoBannerResource extends Resource
{
    protected static ?string $model = PromoBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Megaphone;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Toko';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Judul Promo')->required(),
                Toggle::make('is_active')->label('Aktifkan Banner')->default(true),
                FileUpload::make('image_path')
                    ->label('Upload Banner')
                    ->image()
                    ->directory('promos')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image_path')
                ->label('Banner')
                ->disk('public')
                ->square(),
            TextColumn::make('title')
                ->label('Judul Promo')
                ->searchable()
                ->sortable(),
            IconColumn::make('is_active')
                ->label('Status Aktif')
                ->boolean()
                ->sortable(),
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
            'index' => ListPromoBanners::route('/'),
            'create' => CreatePromoBanner::route('/create'),
            'edit' => EditPromoBanner::route('/{record}/edit'),
        ];
    }
}
