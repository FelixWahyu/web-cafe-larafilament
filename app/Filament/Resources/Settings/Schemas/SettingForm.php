<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('business_name')
                    ->required()
                    ->default('Lav Cafe'),
                TextInput::make('logo'),
                TextInput::make('hero_video'),
                TextInput::make('instagram'),
                TextInput::make('tiktok'),
                TextInput::make('whatsapp'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
            ]);
    }
}
