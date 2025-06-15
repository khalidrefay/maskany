<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            session()->put('locale', $lang);
            app()->setLocale($lang);
        }
        return redirect()->back();
    }
}
