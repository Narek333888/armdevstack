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
        Schema::create('mailer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->default('mailer_setting');
            $table->string('mailer');
            $table->string('host');
            $table->unsignedInteger('port');
            $table->string('username');
            $table->string('password');
            $table->string('encryption');
            $table->string('from_name');
            $table->string('from_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailer_settings');
    }
};
