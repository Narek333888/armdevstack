<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->double('grand_total')->default(0);
            $table->double('sub_total');
            $table->unsignedInteger('product_quantity');
            $table->string('payment_method')->nullable()->default(null);
            $table->unsignedInteger('payment_status')->default(0);
            $table->timestamp('payment_approval_date')->nullable()->default(null);
            $table->string('transaction_id')->nullable()->default(null);
            $table->double('delivery_charge')->default(0);
            $table->double('coupon_price')->default(0);
            $table->unsignedInteger('order_status')->default(0);
            $table->timestamp('order_approval_date')->nullable()->default(null);
            $table->timestamp('order_delivered_date')->nullable()->default(null);
            $table->timestamp('order_completed_date')->nullable()->default(null);
            $table->timestamp('order_declined_date')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
