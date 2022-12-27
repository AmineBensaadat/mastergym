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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->index('FK_subscriptions_members_1')->comment('links to unique record id of members');
            $table->integer('invoice_id')->index('FK_subscriptions_invoice')->comment('links to unique record id of invoice');
            $table->integer('plan_id')->index('FK_subscriptions_plans_2')->comment('links to unique record if of plans');
            $table->date('start_date')->comment('start date of subscription');
            $table->date('end_date')->comment('end date of subscription');
            $table->boolean('status')->comment('0 = expired, 1 = ongoing, 2 = renewed, 3 = canceled');
            $table->boolean('is_renewal')->comment('0= false , 1=true');
            $table->integer('created_by')->unsigned()->index('FK_subscriptions_staff_3');
            $table->integer('updated_by')->unsigned()->index('FK_subscriptions_staff_4');
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
        Schema::dropIfExists('subscriptions');
    }
};
