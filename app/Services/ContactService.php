<?php

namespace App\Services;

use App\Models\Setting;

class ContactService
{
    public function index()
    {
        $setting = Setting::first();
        return compact('setting');
    }
}
