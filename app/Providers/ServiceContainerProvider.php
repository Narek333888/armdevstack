<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(\App\Repositories\Post\Interfaces\IPostsRepository::class, \App\Repositories\Post\PostsRepository::class);
        $this->app->bind(\App\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository::class, \App\Repositories\MailerSetting\MailerSettingsRepository::class);
        $this->app->bind(\App\Repositories\SoftDeletion\Interfaces\ISoftDeletionRepository::class, \App\Repositories\SoftDeletion\SoftDeletionRepository::class);
        $this->app->bind(\App\Repositories\Trash\Interfaces\ITrashableRepository::class, \App\Repositories\Trash\TrashableRepository::class);
        $this->app->bind(\App\Repositories\PostCategory\Interfaces\IPostCategoriesRepository::class, \App\Repositories\PostCategory\PostCategoriesRepository::class);
        $this->app->bind(\App\Repositories\ProductCategory\Interfaces\IProductCategoriesRepository::class, \App\Repositories\ProductCategory\ProductCategoriesRepository::class);
        $this->app->bind(\App\Repositories\Product\Interfaces\IProductsRepository::class, \App\Repositories\Product\ProductsRepository::class);
        $this->app->bind(\App\Repositories\User\Interfaces\IUsersRepository::class, \App\Repositories\User\UsersRepository::class);
        $this->app->bind(\App\Repositories\Role\Interfaces\IRolesRepository::class, \App\Repositories\Role\RolesRepository::class);
        $this->app->bind(\App\Repositories\Permission\Interfaces\IPermissionsRepository::class, \App\Repositories\Permission\PermissionsRepository::class);
        $this->app->bind(\App\Repositories\Frontend\Product\Interfaces\IProductsRepository::class, \App\Repositories\Frontend\Product\ProductsRepository::class);

        $this->app->bind(\App\Contracts\IPaymentGateway::class, function (Application $app)
        {
            $paymentMethod = request()->input('paymentMethod');

            if ($paymentMethod === 'stripe')
            {
                return new \App\Services\Payment\StripePaymentService;
            }
            elseif ($paymentMethod === 'paypal')
            {
                return new \App\Services\Payment\PayPalPaymentService();
            }

            return new \App\Services\Payment\StripePaymentService;
        });

        //Services
        $this->app->bind(\App\Services\WeatherForecast\Interfaces\IWeatherForecastService::class, function (Application $application)
        {
            $service = config('weather-forecast.api_service', 'weatherapi');

            if ($service === 'weatherapi')
                return new \App\Services\WeatherForecast\WeatherApiService;

            return new \App\Services\WeatherForecast\WeatherApiService;
        });

        //Managers
        $this->app->bind(\App\Managers\Interfaces\IImageManager::class, \App\Managers\ImageManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
