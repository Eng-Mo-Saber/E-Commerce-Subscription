<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('order_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 5)->default('EGP');
            $table->string('status')->default('pending'); // paid, failed
            $table->string('payment_method')->nullable(); // card, wallet, etc.
            $table->datetime('payment_date')->nullable();
            $table->text('kashier_response')->nullable();
            $table->timestamps();

            // علاقات
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
