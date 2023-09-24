 <?php
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::group([
'middleware' => ['auth'],
'prefix'=>'dashboard',
'as'=>'dashboard.'
],function(){

    Route::get('/dashboard',[DashBoardController::class,'index'])
    ->middleware(['verified'])->name('dashboard');
    Route::get('categories/trash',[CategoriesController::class,'trash'])
    ->name('categories.trash');
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore');
    Route::delete('categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
    ->name('categories.force-delete');
     Route::resource('categories', CategoriesController::class);
});
