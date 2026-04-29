<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $form):Schema
{
    return $form
        ->schema([
            Section::make('Informasi Produk')
                ->schema([
                    TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // Memicu aksi saat kursor keluar dari kotak (pindah kolom)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->readOnly(),

                    Select::make('category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name') // Mengambil data dari tabel kategori
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),

                    Toggle::make('is_featured')
                        ->label('Tampilkan di Homepage (Unggulan)')
                        ->default(false),
                ])->columns(2), // Membuat form menjadi 2 kolom bersebelahan

            Section::make('Detail & Bahan')
                ->schema([
                    Textarea::make('description')
                        ->label('Deskripsi Produk')
                        ->rows(4),

                    Textarea::make('ingredients')
                        ->label('Bahan / Komposisi')
                        ->rows(3),
                ]),

                Section::make('Gambar Produk')
                    ->components([
                        Repeater::make('images') // Nama relasi di Model Product
                            ->relationship('images')
                            ->label('Daftar Gambar')
                            ->schema([
                                FileUpload::make('image_path') // Nama kolom di tabel product_images
                                    ->label('Upload')
                                    ->image()
                                    ->directory('products')
                                    ->required(),
                            ])
                            ->grid(3) // Tampilkan 3 kolom grid
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
        ]);
}

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table)->columns([
            TextColumn::make('category.name')
                ->label('Kategori')
                ->sortable()
                ->searchable(),

            TextColumn::make('name')
                ->label('Nama Produk')
                ->searchable(),

            TextColumn::make('price')
                ->label('Harga')
                ->money('idr') // Format Rupiah otomatis
                ->sortable(),

            IconColumn::make('is_featured')
                ->label('Unggulan')
                ->boolean(),

            TextColumn::make('updated_at')
                ->label('Terakhir Diubah')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
