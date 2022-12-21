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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id')->index('FK_plans_services');
            $table->string('plan_name', 50)->comment('name of the plan');
            $table->text('plan_details', 65535)->comment('plan details');
            $table->integer('days')->comment('duration of the plans in days');
            $table->integer('amount')->comment('amount to charge for the plan');
            $table->boolean('status')->comment('0 for inactive , 1 for active');
            $table->timestamps();
            $table->integer('created_by')->unsigned()->index('FK_plans_users_1');
            $table->integer('updated_by')->unsigned()->nullable()->index('FK_plans_users_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
