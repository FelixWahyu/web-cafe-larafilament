<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages\CreateSetting;
use App\Filament\Resources\Settings\Pages\EditSetting;
use App\Filament\Resources\Settings\Pages\ListSettings;
use App\Filament\Resources\Settings\Schemas\SettingForm;
use App\Filament\Resources\Settings\Tables\SettingsTable;
use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')->components([
                    TextInput::make('business_name')->label('Nama Bisnis')->required(),
                    FileUpload::make('logo')->label('Logo Web')->image()->directory('settings'),
                    FileUpload::make('hero_video')
                        ->label('Upload Video Hero (MP4/WebM)')
                        ->acceptedFileTypes(['video/mp4', 'video/webm'])
                        ->directory('settings/videos')
                        ->maxSize(51200) // Batas maksimal 50MB
                        ->columnSpanFull(),
                ])->columns(1),

                Section::make('Sosial Media & Kontak')->components([
                    TextInput::make('instagram')->label('Link Instagram')->url(),
                    TextInput::make('tiktok')->label('Link TikTok')->url(),
                    TextInput::make('whatsapp')->label('Nomor WhatsApp (+62)')->numeric()->placeholder('62812...'),
                    TextInput::make('email')->label('Email Cafe')->email(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        // Menghilangkan tombol 'New Setting'
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        // Mencegah pengaturan dihapus
        return false;
    }

    public static function canDeleteAny(): bool
    {
        // Mencegah hapus massal (bulk delete)
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
