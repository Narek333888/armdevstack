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
        $this->app->bind(\App\DAL\Repositories\Post\Interfaces\IPostsRepository::class, \App\DAL\Repositories\Post\PostsRepository::class);
        $this->app->bind(\App\DAL\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository::class, \App\DAL\Repositories\MailerSetting\MailerSettingsRepository::class);
        $this->app->bind(\App\DAL\Repositories\SoftDeletion\Interfaces\ISoftDeletionRepository::class, \App\DAL\Repositories\SoftDeletion\SoftDeletionRepository::class);
        $this->app->bind(\App\DAL\Repositories\Trash\Interfaces\ITrashableRepository::class, \App\DAL\Repositories\Trash\TrashableRepository::class);
        $this->app->bind(\App\DAL\Repositories\PostCategory\Interfaces\IPostCategoriesRepository::class, \App\DAL\Repositories\PostCategory\PostCategoriesRepository::class);
        $this->app->bind(\App\DAL\Repositories\ProductCategory\Interfaces\IProductCategoriesRepository::class, \App\DAL\Repositories\ProductCategory\ProductCategoriesRepository::class);
        $this->app->bind(\App\DAL\Repositories\Product\Interfaces\IProductsRepository::class, \App\DAL\Repositories\Product\ProductsRepository::class);
        $this->app->bind(\App\DAL\Repositories\User\Interfaces\IUsersRepository::class, \App\DAL\Repositories\User\UsersRepository::class);
        $this->app->bind(\App\DAL\Repositories\Role\Interfaces\IRolesRepository::class, \App\DAL\Repositories\Role\RolesRepository::class);
        $this->app->bind(\App\DAL\Repositories\Permission\Interfaces\IPermissionsRepository::class, \App\DAL\Repositories\Permission\PermissionsRepository::class);
        $this->app->bind(\App\DAL\Repositories\Frontend\Product\Interfaces\IProductsRepository::class, \App\DAL\Repositories\Frontend\Product\ProductsRepository::class);

        $this->app->bind(\App\Contracts\IPaymentGateway::class, function (Application $app)
        {
            $paymentMethod = request()->input('paymentMethod');

            if ($paymentMethod === 'stripe')
            {
                return new \App\DAL\Services\Payment\StripePaymentService;
            }
            elseif ($paymentMethod === 'paypal')
            {
                return new \App\DAL\Services\Payment\PayPalPaymentService();
            }

            return new \App\DAL\Services\Payment\StripePaymentService;
        });

        //Services
        $this->app->bind(\App\DAL\Services\WeatherForecast\Interfaces\IWeatherForecastService::class, function (Application $app)
        {
            $service = config('weather-forecast.api_service', 'weatherapi');

            if ($service === 'weatherapi')
                return new \App\DAL\Services\WeatherForecast\WeatherApiService;

            return new \App\DAL\Services\WeatherForecast\WeatherApiService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
