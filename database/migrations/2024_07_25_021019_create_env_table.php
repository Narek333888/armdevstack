<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('env', function (Blueprint $table)
        {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('app_env')->nullable();
            $table->string('app_debug')->nullable();
            $table->string('app_timezone')->nullable();
            $table->string('app_url')->nullable();
            $table->string('app_locale')->nullable();
            $table->string('app_fallback_locale')->nullable();
            $table->string('app_faker_locale')->nullable();
            $table->string('app_maintenance_driver')->nullable();
            $table->string('app_maintenance_store')->nullable();
            $table->integer('bcrypt_rounds')->nullable();
            $table->string('log_channel')->nullable();
            $table->string('log_stack')->nullable();
            $table->string('log_deprecations_channel')->nullable();
            $table->string('log_level')->nullable();
            $table->string('db_connection')->nullable();
            $table->string('db_host')->nullable();
            $table->integer('db_port')->nullable();
            $table->string('db_database')->nullable();
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
            $table->string('session_driver')->nullable();
            $table->integer('session_lifetime')->nullable();
            $table->boolean('session_encrypt')->nullable();
            $table->string('session_path')->nullable();
            $table->string('session_domain')->nullable();
            $table->string('broadcast_connection')->nullable();
            $table->string('filesystem_disk')->nullable();
            $table->string('queue_connection')->nullable();
            $table->string('cache_store')->nullable();
            $table->string('cache_prefix')->nullable();
            $table->string('memcached_host')->nullable();
            $table->string('redis_client')->nullable();
            $table->string('redis_host')->nullable();
            $table->string('redis_password')->nullable();
            $table->integer('redis_port')->nullable();
            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('aws_access_key_id')->nullable();
            $table->string('aws_secret_access_key')->nullable();
            $table->string('aws_default_region')->nullable();
            $table->string('aws_bucket')->nullable();
            $table->boolean('aws_use_path_style_endpoint')->nullable();
            $table->string('pusher_app_id')->nullable();
            $table->string('pusher_app_key')->nullable();
            $table->string('pusher_app_secret')->nullable();
            $table->string('pusher_host')->nullable();
            $table->integer('pusher_port')->nullable();
            $table->string('pusher_scheme')->nullable();
            $table->string('pusher_app_cluster')->nullable();
            $table->string('vite_app_name')->nullable();
            $table->string('vite_pusher_app_key')->nullable();
            $table->string('vite_pusher_host')->nullable();
            $table->integer('vite_pusher_port')->nullable();
            $table->string('vite_pusher_scheme')->nullable();
            $table->string('vite_pusher_app_cluster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('env');
    }
};
