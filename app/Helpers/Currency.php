<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;
use PSpell\Config;

class Currency {

    public static function format($amount , $currency = null){
        $baseCurrency = Config('app.currency','USD');
        $formatter = new NumberFormatter( config('app.locale'), NumberFormatter::CURRENCY );

        if($currency === null){
            $currency = Session::get( 'currency_code',$baseCurrency);
            // $currency = config('app.currency','USD');
        }
        if($currency != $baseCurrency){
            $rate = Cache::get('currency_rate'. $currency,1);
            $amount = $amount * $rate;
        }
        return $formatter->formatCurrency($amount,$currency);

    }

}
