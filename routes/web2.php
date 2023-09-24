<?php

// use App\Http\Controllers\Test;

use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('dashboard/index', [DashBoardController::class,'index']);
// Route::get('dashboard/index','DashBoardController@index');

// $router = app()->make('router');
// $router->get('/',function (){
//     return 'hello';
// });
// Route::get('/f/{f?}', function ($f =null) {
//   return    $f ?: 10800;


//     return in_array($f, config('fortify.features', []));

// });
// Route::get(\Laravel\Fortify\RoutePath::for('password.reset', '/reset-password/{token}'), function ($token){
// //    return $token;
//     return view('auth.password-reset',['token'=>$token]);
// })
    // ->middleware(['guest:'.config('fortify.guard')])
    // ->name('password.reset');
