<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product:: with('category')->active()->latest('id')->limit(8)->get();
        // $products = Product:: with('category')->withoutGlobalScope('store')->active()->limit(8)->get();
        // dd($products);
        return view('front.home',compact('products'));
    }
}
