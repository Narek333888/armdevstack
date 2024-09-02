<?php

use app\Http\Controllers\Dashboard\MailerSettingController;
use app\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\PermissionController;
use app\Http\Controllers\Dashboard\PostCategoryController;
use app\Http\Controllers\Dashboard\PostController;
use app\Http\Controllers\Dashboard\ProductCategoryController;
use app\Http\Controllers\Dashboard\ProductController;
use app\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use app\Http\Controllers\Dashboard\TrashController;
use App\Http\Controllers\Dashboard\UserController;
use app\Http\Controllers\Dashboard\WeatherForecastController;
use App\Http\Controllers\Frontend\SiteController;
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
    Route::get('/', [SiteController::class, 'index'])->name('site.index');

    Route::middleware(['auth', 'verified'])->prefix('/dashboard')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('main.index');

        Route::prefix('/weather')->group(function () {
            Route::get('/', [WeatherForecastController::class, 'show'])->name('weather.show');
            Route::get('/fetch-data', [WeatherForecastController::class, 'fetchData'])->name('weather.fetch');
            Route::get('/clear-cache/{key}', [WeatherForecastController::class, 'clearCache'])->name('weather.clear-cache');
        });

        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('/{id}/update', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
            Route::delete('/{id}/soft-delete', [UserController::class, 'softDelete'])->name('user.soft-delete');
            Route::delete('/delete-multiple', [UserController::class, 'deleteMultiple'])->name('user.delete-multiple');
            Route::delete('/soft-delete-multiple', [UserController::class, 'softDeleteMultiple'])->name('user.soft-delete-multiple');
            Route::delete('/delete-all', [UserController::class, 'deleteAll'])->name('user.delete-all');
            Route::delete('/soft-delete-all', [UserController::class, 'softDeleteAll'])->name('user.soft-delete-all');
        });

        Route::prefix('/roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/{id}/update', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/{id}/delete', [RoleController::class, 'delete'])->name('role.delete');
            Route::delete('/{id}/soft-delete', [RoleController::class, 'softDelete'])->name('role.soft-delete');
            Route::delete('/delete-multiple', [RoleController::class, 'deleteMultiple'])->name('role.delete-multiple');
            Route::delete('/soft-delete-multiple', [RoleController::class, 'softDeleteMultiple'])->name('role.soft-delete-multiple');
            Route::delete('/delete-all', [RoleController::class, 'deleteAll'])->name('role.delete-all');
            Route::delete('/soft-delete-all', [RoleController::class, 'softDeleteAll'])->name('role.soft-delete-all');
            Route::get('/{id}/add-permission-to-role', [RoleController::class, 'addPermissionToRole'])->name('role.add-permission-to-role');
            Route::put('/{id}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('role.give-permission-to-role');
        });

        Route::prefix('/permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
            Route::patch('/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
            Route::delete('/{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete');
            Route::delete('/{id}/soft-delete', [PermissionController::class, 'softDelete'])->name('permission.soft-delete');
            Route::delete('/delete-multiple', [PermissionController::class, 'deleteMultiple'])->name('permission.delete-multiple');
            Route::delete('/soft-delete-multiple', [PermissionController::class, 'softDeleteMultiple'])->name('permission.soft-delete-multiple');
            Route::delete('/delete-all', [PermissionController::class, 'deleteAll'])->name('permission.delete-all');
            Route::delete('/soft-delete-all', [PermissionController::class, 'softDeleteAll'])->name('permission.soft-delete-all');
        });

        Route::prefix('/posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::get('/create', [PostController::class, 'create'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->name('post.store');
            Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
            Route::get('/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
            Route::patch('/{id}/update', [PostController::class, 'update'])->name('post.update');
            Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('post.delete');
            Route::delete('/{id}/soft-delete', [PostController::class, 'softDelete'])->name('post.soft-delete');
            Route::post('/copy/{id}', [PostController::class, 'copy'])->name('post.copy');
            Route::delete('/delete-multiple', [PostController::class, 'deleteMultiple'])->name('post.delete-multiple');
            Route::delete('/soft-delete-multiple', [PostController::class, 'softDeleteMultiple'])->name('post.soft-delete-multiple');
            Route::delete('/delete-all', [PostController::class, 'deleteAll'])->name('post.delete-all');
            Route::delete('/soft-delete-all', [PostController::class, 'softDeleteAll'])->name('post.soft-delete-all');
        });

        Route::prefix('/post-categories')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index'])->name('post-category.index');
            Route::get('/create', [PostCategoryController::class, 'create'])->name('post-category.create');
            Route::post('/store', [PostCategoryController::class, 'store'])->name('post-category.store');
            Route::get('/{id}', [PostCategoryController::class, 'show'])->name('post-category.show');
            Route::get('/{id}/edit', [PostCategoryController::class, 'edit'])->name('post-category.edit');
            Route::patch('/{id}/update', [PostCategoryController::class, 'update'])->name('post-category.update');
            Route::delete('/{id}/delete', [PostCategoryController::class, 'delete'])->name('post-category.delete');
            Route::delete('/{id}/soft-delete', [PostCategoryController::class, 'softDelete'])->name('post-category.soft-delete');
            Route::post('/copy/{id}', [PostCategoryController::class, 'copy'])->name('post-category.copy');
            Route::delete('/delete-multiple', [PostCategoryController::class, 'deleteMultiple'])->name('post-category.delete-multiple');
            Route::delete('/soft-delete-multiple', [PostCategoryController::class, 'softDeleteMultiple'])->name('post-category.soft-delete-multiple');
            Route::delete('/delete-all', [PostCategoryController::class, 'deleteAll'])->name('post-category.delete-all');
            Route::delete('/soft-delete-all', [PostCategoryController::class, 'softDeleteAll'])->name('post-category.soft-delete-all');
        });

        Route::prefix('/product-categories')->group(function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('product-category.index');
            Route::get('/create', [ProductCategoryController::class, 'create'])->name('product-category.create');
            Route::post('/store', [ProductCategoryController::class, 'store'])->name('product-category.store');
            Route::get('/{id}', [ProductCategoryController::class, 'show'])->name('product-category.show');
            Route::get('/{id}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit');
            Route::patch('/{id}/update', [ProductCategoryController::class, 'update'])->name('product-category.update');
            Route::delete('/{id}/delete', [ProductCategoryController::class, 'delete'])->name('product-category.delete');
            Route::delete('/{id}/soft-delete', [ProductCategoryController::class, 'softDelete'])->name('product-category.soft-delete');
            Route::post('/copy/{id}', [ProductCategoryController::class, 'copy'])->name('product-category.copy');
            Route::delete('/delete-multiple', [ProductCategoryController::class, 'deleteMultiple'])->name('product-category.delete-multiple');
            Route::delete('/soft-delete-multiple', [ProductCategoryController::class, 'softDeleteMultiple'])->name('product-category.soft-delete-multiple');
            Route::delete('/delete-all', [ProductCategoryController::class, 'deleteAll'])->name('product-category.delete-all');
            Route::delete('/soft-delete-all', [ProductCategoryController::class, 'softDeleteAll'])->name('product-category.soft-delete-all');
        });

        Route::prefix('/products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::patch('/{id}/update', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
            Route::delete('/{id}/soft-delete', [ProductController::class, 'softDelete'])->name('product.soft-delete');
            Route::post('/copy/{id}', [ProductController::class, 'copy'])->name('product.copy');
            Route::delete('/delete-multiple', [ProductController::class, 'deleteMultiple'])->name('product.delete-multiple');
            Route::delete('/soft-delete-multiple', [ProductController::class, 'softDeleteMultiple'])->name('product.soft-delete-multiple');
            Route::delete('/delete-all', [ProductController::class, 'deleteAll'])->name('product.delete-all');
            Route::delete('/soft-delete-all', [ProductController::class, 'softDeleteAll'])->name('product.soft-delete-all');
        });

        Route::prefix('/settings')->group(function () {
            Route::get('/mailer', [MailerSettingController::class, 'index'])->name('mailer-settings.index');
            Route::post('update-or-create', [MailerSettingController::class, 'updateOrCreate'])->name('mailer-settings.update-or-create');
        });

        Route::prefix('/trash')->group(function () {
            Route::get('/', [TrashController::class, 'index'])->name('trash.index');
            Route::post('/restore/{model}/{id}', [TrashController::class, 'restore'])->name('trash.restore');
            Route::post('/restore-all/{model}', [TrashController::class, 'restoreAll'])->name('trash.restore-all');
            Route::delete('/delete/{model}/{id}', [TrashController::class, 'delete'])->name('trash.delete');
            Route::delete('/delete-all/{model}', [TrashController::class, 'deleteAll'])->name('trash.delete-all');
        });

        Route::prefix('/profile')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
});

require __DIR__.'/auth.php';

