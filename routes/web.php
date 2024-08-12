<?php

use App\Http\Controllers\MailerSettingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\WeatherController;
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
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('main.index');

        Route::get('/weather', [WeatherController::class, 'showWeather'])->name('weather.show');

        Route::prefix('posts')->group(function () {
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

        Route::prefix('post-categories')->group(function () {
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

        Route::prefix('product-categories')->group(function () {
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

        Route::prefix('settings')->group(function () {
            Route::get('/mailer', [MailerSettingController::class, 'index'])->name('mailer-settings.index');
            Route::post('update-or-create', [MailerSettingController::class, 'updateOrCreate'])->name('mailer-settings.update-or-create');
        });

        Route::prefix('trash')->group(function () {
            Route::get('/', [TrashController::class, 'index'])->name('trash.index');
            Route::post('/restore/{model}/{id}', [TrashController::class, 'restore'])->name('trash.restore');
            Route::post('/restore-all/{model}', [TrashController::class, 'restoreAll'])->name('trash.restore-all');
            Route::delete('/delete/{model}/{id}', [TrashController::class, 'delete'])->name('trash.delete');
            Route::delete('/delete-all/{model}', [TrashController::class, 'deleteAll'])->name('trash.delete-all');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';

