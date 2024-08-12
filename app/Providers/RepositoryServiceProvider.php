<?php

namespace App\Providers;

use App\DAL\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository;
use App\DAL\Repositories\MailerSetting\MailerSettingsRepository;
use App\DAL\Repositories\Post\Interfaces\IPostsRepository;
use App\DAL\Repositories\Post\PostsRepository;
use App\DAL\Repositories\PostCategory\Interfaces\IPostCategoriesRepository;
use App\DAL\Repositories\PostCategory\PostCategoriesRepository;
use App\DAL\Repositories\ProductCategory\Interfaces\IProductCategoriesRepository;
use App\DAL\Repositories\ProductCategory\ProductCategoriesRepository;
use App\DAL\Repositories\SoftDeletion\Interfaces\ISoftDeletionRepository;
use App\DAL\Repositories\SoftDeletion\SoftDeletionRepository;
use App\DAL\Repositories\Trash\Interfaces\ITrashableRepository;
use App\DAL\Repositories\Trash\TrashableRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(IPostsRepository::class, PostsRepository::class);
        $this->app->singleton(IMailerSettingsRepository::class, MailerSettingsRepository::class);
        $this->app->singleton(ISoftDeletionRepository::class, SoftDeletionRepository::class);
        $this->app->singleton(ITrashableRepository::class, TrashableRepository::class);
        $this->app->singleton(IPostCategoriesRepository::class, PostCategoriesRepository::class);
        $this->app->singleton(IProductCategoriesRepository::class, ProductCategoriesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
