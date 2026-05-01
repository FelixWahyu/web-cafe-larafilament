<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    public function getHeading(): string | Htmlable | null
    {
        return new HtmlString('Selamat Datang Kembali');
    }

    public function getSubheading(): string | Htmlable | null
    {
        return new HtmlString('Masuk ke panel admin Lav Cafe');
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
