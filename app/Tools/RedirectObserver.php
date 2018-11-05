<?php

namespace App\Tools;


use App\Models\Transition;
use Illuminate\Http\Request;

class RedirectObserver
{
    public static function gatherInfo($url, Request $request)
    {
        $ip = $request->ip();

        if ($ip == '127.0.0.1') {
            $country = 'localhost';
        } else {
            $country = (new \Stevebauman\Location\Location)->get()->countryCode ?? 'n/a';

        }

        Transition::create([
            'url_id' => $url->id,
            'browser' => get_browser($request->header('User-Agent'))->browser,
            'country' => $country,
            'operating_system' => DetectedOs::getOS($_SERVER['HTTP_USER_AGENT']),
        ]);
    }
}