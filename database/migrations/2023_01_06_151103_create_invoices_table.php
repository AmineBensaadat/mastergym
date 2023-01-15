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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('service_id');
            $table->integer('plan_id');
            $table->integer('subscription-price');
            $table->integer('amount_pending')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discount-amount')->nullable();
            $table->string('payment-mode');
            $table->integer('additional-fees')->nullable();
            $table->string('status');
            $table->longText('payment-comment')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
