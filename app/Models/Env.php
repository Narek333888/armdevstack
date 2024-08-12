<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Env extends Model
{
    use HasFactory;

    protected $table = 'env';

    protected $fillable = [
        'app_name',
        'app_env',
        'app_debug',
        'app_timezone',
        'app_url',
        'app_locale',
        'app_fallback_locale',
        'app_faker_locale',
        'app_maintenance_driver',
        'app_maintenance_store',
        'bcrypt_rounds',
        'log_channel',
        'log_stack',
        'log_deprecations_channel',
        'log_level',
        'db_connection',
        'db_host',
        'db_port',
        'db_database',
        'db_username',
        'db_password',
        'session_driver',
        'session_lifetime',
        'session_encrypt',
        'session_path',
        'session_domain',
        'broadcast_connection',
        'filesystem_disk',
        'queue_connection',
        'cache_store',
        'cache_prefix',
        'memcached_host',
        'redis_client',
        'redis_host',
        'redis_password',
        'redis_port',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'aws_access_key_id',
        'aws_secret_access_key',
        'aws_default_region',
        'aws_bucket',
        'aws_use_path_style_endpoint',
        'pusher_app_id',
        'pusher_app_key',
        'pusher_app_secret',
        'pusher_host',
        'pusher_port',
        'pusher_scheme',
        'pusher_app_cluster',
        'vite_app_name',
        'vite_pusher_app_key',
        'vite_pusher_host',
        'vite_pusher_port',
        'vite_pusher_scheme',
        'vite_pusher_app_cluster',
    ];
}
