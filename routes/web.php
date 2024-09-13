<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/refresh-app', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');

    return redirect()->route('main.index');
})->middleware('auth');

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\SiteController::class, 'index'])->name('site.index');

    Route::prefix('/products')->name('frontend.')->group(function() {
        Route::get('/', [\App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('product.index');
    });

    Route::prefix('/payment')->group(function () {
        Route::get('/checkout/{product}', [\App\Http\Controllers\Payment\PaymentController::class, 'checkout'])->name('payment.checkout');
        Route::get('/success', [\App\Http\Controllers\Payment\PaymentController::class, 'success'])->name('payment.success');
        Route::get('/failure', [\App\Http\Controllers\Payment\PaymentController::class, 'failure'])->name('payment.failure');
        Route::get('/cancel', [\App\Http\Controllers\Payment\PaymentController::class, 'cancel'])->name('payment.cancel');
        Route::post('/charge/{product}', [\App\Http\Controllers\Payment\PaymentController::class, 'charge'])->name('payment.charge');
    });

    Route::middleware(['auth', 'verified'])->prefix('/dashboard')->group(function () {
        Route::get('/', [\app\Http\Controllers\Dashboard\MainController::class, 'index'])->name('main.index');

        Route::prefix('/weather')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\WeatherForecastController::class, 'show'])->name('weather.show');
            Route::get('/fetch-data', [\app\Http\Controllers\Dashboard\WeatherForecastController::class, 'fetchData'])->name('weather.fetch');
            Route::get('/clear-cache/{key}', [\app\Http\Controllers\Dashboard\WeatherForecastController::class, 'clearCache'])->name('weather.clear-cache');
        });

        Route::prefix('/users')->group(function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('user.index');
            Route::get('/create', [\App\Http\Controllers\Dashboard\UserController::class, 'create'])->name('user.create');
            Route::post('/store', [\App\Http\Controllers\Dashboard\UserController::class, 'store'])->name('user.store');
            Route::get('/{id}', [\App\Http\Controllers\Dashboard\UserController::class, 'show'])->name('user.show');
            Route::get('/{id}/edit', [\App\Http\Controllers\Dashboard\UserController::class, 'edit'])->name('user.edit');
            Route::patch('/{id}/update', [\App\Http\Controllers\Dashboard\UserController::class, 'update'])->name('user.update');
            Route::delete('/{id}/delete', [\App\Http\Controllers\Dashboard\UserController::class, 'delete'])->name('user.delete');
            Route::delete('/{id}/soft-delete', [\App\Http\Controllers\Dashboard\UserController::class, 'softDelete'])->name('user.soft-delete');
            Route::delete('/delete-multiple', [\App\Http\Controllers\Dashboard\UserController::class, 'deleteMultiple'])->name('user.delete-multiple');
            Route::delete('/soft-delete-multiple', [\App\Http\Controllers\Dashboard\UserController::class, 'softDeleteMultiple'])->name('user.soft-delete-multiple');
            Route::delete('/delete-all', [\App\Http\Controllers\Dashboard\UserController::class, 'deleteAll'])->name('user.delete-all');
            Route::delete('/soft-delete-all', [\App\Http\Controllers\Dashboard\UserController::class, 'softDeleteAll'])->name('user.soft-delete-all');
        });

        Route::prefix('/roles')->group(function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\RoleController::class, 'index'])->name('role.index');
            Route::get('/create', [\App\Http\Controllers\Dashboard\RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [\App\Http\Controllers\Dashboard\RoleController::class, 'store'])->name('role.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Dashboard\RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/{id}/update', [\App\Http\Controllers\Dashboard\RoleController::class, 'update'])->name('role.update');
            Route::delete('/{id}/delete', [\App\Http\Controllers\Dashboard\RoleController::class, 'delete'])->name('role.delete');
            Route::delete('/{id}/soft-delete', [\App\Http\Controllers\Dashboard\RoleController::class, 'softDelete'])->name('role.soft-delete');
            Route::delete('/delete-multiple', [\App\Http\Controllers\Dashboard\RoleController::class, 'deleteMultiple'])->name('role.delete-multiple');
            Route::delete('/soft-delete-multiple', [\App\Http\Controllers\Dashboard\RoleController::class, 'softDeleteMultiple'])->name('role.soft-delete-multiple');
            Route::delete('/delete-all', [\App\Http\Controllers\Dashboard\RoleController::class, 'deleteAll'])->name('role.delete-all');
            Route::delete('/soft-delete-all', [\App\Http\Controllers\Dashboard\RoleController::class, 'softDeleteAll'])->name('role.soft-delete-all');
            Route::get('/{id}/add-permission-to-role', [\App\Http\Controllers\Dashboard\RoleController::class, 'addPermissionToRole'])->name('role.add-permission-to-role');
            Route::put('/{id}/give-permissions', [\App\Http\Controllers\Dashboard\RoleController::class, 'givePermissionToRole'])->name('role.give-permission-to-role');
        });

        Route::prefix('/permissions')->group(function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\PermissionController::class, 'index'])->name('permission.index');
            Route::get('/create', [\App\Http\Controllers\Dashboard\PermissionController::class, 'create'])->name('permission.create');
            Route::post('/store', [\App\Http\Controllers\Dashboard\PermissionController::class, 'store'])->name('permission.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Dashboard\PermissionController::class, 'edit'])->name('permission.edit');
            Route::patch('/{id}/update', [\App\Http\Controllers\Dashboard\PermissionController::class, 'update'])->name('permission.update');
            Route::delete('/{id}/delete', [\App\Http\Controllers\Dashboard\PermissionController::class, 'delete'])->name('permission.delete');
            Route::delete('/{id}/soft-delete', [\App\Http\Controllers\Dashboard\PermissionController::class, 'softDelete'])->name('permission.soft-delete');
            Route::delete('/delete-multiple', [\App\Http\Controllers\Dashboard\PermissionController::class, 'deleteMultiple'])->name('permission.delete-multiple');
            Route::delete('/soft-delete-multiple', [\App\Http\Controllers\Dashboard\PermissionController::class, 'softDeleteMultiple'])->name('permission.soft-delete-multiple');
            Route::delete('/delete-all', [\App\Http\Controllers\Dashboard\PermissionController::class, 'deleteAll'])->name('permission.delete-all');
            Route::delete('/soft-delete-all', [\App\Http\Controllers\Dashboard\PermissionController::class, 'softDeleteAll'])->name('permission.soft-delete-all');
        });

        Route::prefix('/posts')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\PostController::class, 'index'])->name('post.index');
            Route::get('/create', [\app\Http\Controllers\Dashboard\PostController::class, 'create'])->name('post.create');
            Route::post('/store', [\app\Http\Controllers\Dashboard\PostController::class, 'store'])->name('post.store');
            Route::get('/{id}', [\app\Http\Controllers\Dashboard\PostController::class, 'show'])->name('post.show');
            Route::get('/{id}/edit', [\app\Http\Controllers\Dashboard\PostController::class, 'edit'])->name('post.edit');
            Route::patch('/{id}/update', [\app\Http\Controllers\Dashboard\PostController::class, 'update'])->name('post.update');
            Route::delete('/{id}/delete', [\app\Http\Controllers\Dashboard\PostController::class, 'delete'])->name('post.delete');
            Route::delete('/{id}/soft-delete', [\app\Http\Controllers\Dashboard\PostController::class, 'softDelete'])->name('post.soft-delete');
            Route::post('/copy/{id}', [\app\Http\Controllers\Dashboard\PostController::class, 'copy'])->name('post.copy');
            Route::delete('/delete-multiple', [\app\Http\Controllers\Dashboard\PostController::class, 'deleteMultiple'])->name('post.delete-multiple');
            Route::delete('/soft-delete-multiple', [\app\Http\Controllers\Dashboard\PostController::class, 'softDeleteMultiple'])->name('post.soft-delete-multiple');
            Route::delete('/delete-all', [\app\Http\Controllers\Dashboard\PostController::class, 'deleteAll'])->name('post.delete-all');
            Route::delete('/soft-delete-all', [\app\Http\Controllers\Dashboard\PostController::class, 'softDeleteAll'])->name('post.soft-delete-all');
        });

        Route::prefix('/post-categories')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'index'])->name('post-category.index');
            Route::get('/create', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'create'])->name('post-category.create');
            Route::post('/store', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'store'])->name('post-category.store');
            Route::get('/{id}', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'show'])->name('post-category.show');
            Route::get('/{id}/edit', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'edit'])->name('post-category.edit');
            Route::patch('/{id}/update', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'update'])->name('post-category.update');
            Route::delete('/{id}/delete', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'delete'])->name('post-category.delete');
            Route::delete('/{id}/soft-delete', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'softDelete'])->name('post-category.soft-delete');
            Route::post('/copy/{id}', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'copy'])->name('post-category.copy');
            Route::delete('/delete-multiple', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'deleteMultiple'])->name('post-category.delete-multiple');
            Route::delete('/soft-delete-multiple', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'softDeleteMultiple'])->name('post-category.soft-delete-multiple');
            Route::delete('/delete-all', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'deleteAll'])->name('post-category.delete-all');
            Route::delete('/soft-delete-all', [\app\Http\Controllers\Dashboard\PostCategoryController::class, 'softDeleteAll'])->name('post-category.soft-delete-all');
        });

        Route::prefix('/product-categories')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'index'])->name('product-category.index');
            Route::get('/create', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'create'])->name('product-category.create');
            Route::post('/store', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'store'])->name('product-category.store');
            Route::get('/{id}', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'show'])->name('product-category.show');
            Route::get('/{id}/edit', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'edit'])->name('product-category.edit');
            Route::patch('/{id}/update', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'update'])->name('product-category.update');
            Route::delete('/{id}/delete', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'delete'])->name('product-category.delete');
            Route::delete('/{id}/soft-delete', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'softDelete'])->name('product-category.soft-delete');
            Route::post('/copy/{id}', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'copy'])->name('product-category.copy');
            Route::delete('/delete-multiple', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'deleteMultiple'])->name('product-category.delete-multiple');
            Route::delete('/soft-delete-multiple', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'softDeleteMultiple'])->name('product-category.soft-delete-multiple');
            Route::delete('/delete-all', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'deleteAll'])->name('product-category.delete-all');
            Route::delete('/soft-delete-all', [\app\Http\Controllers\Dashboard\ProductCategoryController::class, 'softDeleteAll'])->name('product-category.soft-delete-all');
        });

        Route::prefix('/products')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [\app\Http\Controllers\Dashboard\ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [\app\Http\Controllers\Dashboard\ProductController::class, 'store'])->name('product.store');
            Route::get('/{id}', [\app\Http\Controllers\Dashboard\ProductController::class, 'show'])->name('product.show');
            Route::get('/{id}/edit', [\app\Http\Controllers\Dashboard\ProductController::class, 'edit'])->name('product.edit');
            Route::patch('/{id}/update', [\app\Http\Controllers\Dashboard\ProductController::class, 'update'])->name('product.update');
            Route::delete('/{id}/delete', [\app\Http\Controllers\Dashboard\ProductController::class, 'delete'])->name('product.delete');
            Route::delete('/{id}/soft-delete', [\app\Http\Controllers\Dashboard\ProductController::class, 'softDelete'])->name('product.soft-delete');
            Route::post('/copy/{id}', [\app\Http\Controllers\Dashboard\ProductController::class, 'copy'])->name('product.copy');
            Route::delete('/delete-multiple', [\app\Http\Controllers\Dashboard\ProductController::class, 'deleteMultiple'])->name('product.delete-multiple');
            Route::delete('/soft-delete-multiple', [\app\Http\Controllers\Dashboard\ProductController::class, 'softDeleteMultiple'])->name('product.soft-delete-multiple');
            Route::delete('/delete-all', [\app\Http\Controllers\Dashboard\ProductController::class, 'deleteAll'])->name('product.delete-all');
            Route::delete('/soft-delete-all', [\app\Http\Controllers\Dashboard\ProductController::class, 'softDeleteAll'])->name('product.soft-delete-all');
        });

        Route::prefix('/settings')->group(function () {
            Route::get('/mailer', [\app\Http\Controllers\Dashboard\MailerSettingController::class, 'index'])->name('mailer-settings.index');
            Route::post('update-or-create', [\app\Http\Controllers\Dashboard\MailerSettingController::class, 'updateOrCreate'])->name('mailer-settings.update-or-create');
        });

        Route::prefix('/trash')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\TrashController::class, 'index'])->name('trash.index');
            Route::post('/restore/{model}/{id}', [\app\Http\Controllers\Dashboard\TrashController::class, 'restore'])->name('trash.restore');
            Route::post('/restore-all/{model}', [\app\Http\Controllers\Dashboard\TrashController::class, 'restoreAll'])->name('trash.restore-all');
            Route::delete('/delete/{model}/{id}', [\app\Http\Controllers\Dashboard\TrashController::class, 'delete'])->name('trash.delete');
            Route::delete('/delete-all/{model}', [\app\Http\Controllers\Dashboard\TrashController::class, 'deleteAll'])->name('trash.delete-all');
        });

        Route::prefix('/profile')->group(function () {
            Route::get('/', [\app\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [\app\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [\app\Http\Controllers\Dashboard\ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
});

require __DIR__.'/auth.php';
