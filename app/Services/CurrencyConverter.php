<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $appKey;
    protected $baseUrl ="https://free.currconv.com/api/v7";
    public function __construct($appKey)
    {
        $this->appKey = $appKey;
    }
    public function convert(string $from, string $to, $amount = 1)
    {
        $q = "{$from}_{$to}";
       $response = Http::baseUrl($this->baseUrl)
         ->get('/convert',[
            "q"=> $q,
            "compact"=> "y",
            "apiKey"=> $this->appKey,
         ]);
         $result = $response->json();
         return $result[$q]['val'] * $amount;

    }
}
