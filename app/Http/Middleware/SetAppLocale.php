<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $lang = request('lang',session()->get('lang',Config::get('lang','en')));
        // if ($lang && $lang !==  session()->get('lang')) {
        // session()->put('lang',$lang);
        // app()->setLocale($lang);
        // }else {
        // app()->setLocale($lang);
        // }
        $lang = request('lang',Cookie::get('lang',Config::get('app.locale','en')));
        App::setLocale($lang);
        Cookie::queue('lang', $lang,60 * 24 * 365);

        // Route::current()->forgetParameter('locale');
        return $next($request);
    }
}
