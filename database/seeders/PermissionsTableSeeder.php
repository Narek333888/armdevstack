<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Utilities\CacheUtility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CacheUtility::clearPaginatedItemsCache(Permission::class);

        Permission::query()->insert([
            ['name' => 'create role', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update role', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete role', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create permission', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update permission', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete permission', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view post category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create post category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update post category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete post category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view post', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create post', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update post', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete post', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view product category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create product category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update product category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete product category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view product', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create product', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update product', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete product', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update or create mailer settings', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
