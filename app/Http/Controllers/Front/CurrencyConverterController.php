<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session ;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "currency_code"=> "required|string|size:3",
        ]);
        $baseCurrencyCode = Config::get("app.currency",'USD');
        $currencyCode = $request->input("currency_code");
        $cache_key = "currency_rate_".$currencyCode;
        $rate = Cache::get($cache_key,0);
        if(!$rate)
        {
            // $converter = new CurrencyConverter(Config::get("services.currency_converter.app_key"));
            // $rate = $converter->convert($baseCurrencyCode, $currencyCode);
            Cache::put($cache_key, $rate, now()->addMinutes(60));
        }
        Session::put('currency_code',$currencyCode);
        return redirect()->back();
    }
}
