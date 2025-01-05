 <?php

    use App\Http\Controllers\Dashboard\AdminController;
    use App\Http\Controllers\Dashboard\RoleController;
    use App\Http\Controllers\DashBoardController;
    use App\Http\Controllers\Dashboard\CategoriesController;
    use App\Http\Controllers\Dashboard\ProductController;
    use App\Http\Controllers\Dashboard\ProfileController;
    use App\Http\Controllers\Dashboard\UserController;
    use App\Http\Middleware\CheckUserType;
    use Illuminate\Support\Facades\Route;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    Route::group([
        // 'middleware' => ['auth',"App\Http\Middleware\CheckUserType:admin,user"],
        'middleware' => ['auth:admin,web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        // 'middleware' => ['auth','auth.type:user,admin,super-admin'],
        'prefix' => LaravelLocalization::setLocale() . '/admin/dashboard',
        'as' => 'dashboard.'
    ], function () {
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/', [DashBoardController::class, 'index'])
            // ->middleware(['verified'])
            ->name('dashboard');
        Route::get('categories/trash', [CategoriesController::class, 'trash'])
            ->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
            ->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
            ->name('categories.force-delete');
        //  Route::resource('categories', CategoriesController::class);
        //  Route::resource('products', ProductController::class);
        //  Route::resource('roles', RoleController::class);
        Route::resources([
            'categories' => CategoriesController::class,
            'products' => ProductController::class,
            'roles' => RoleController::class,
            'users' => UserController::class,
            'admins' => AdminController::class,
        ]);
    });
