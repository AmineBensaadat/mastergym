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
        Schema::create('coach', function (Blueprint $table) {
            $table->id()->comment('Unique Record Id for system');
            $table->string('firstname', 50)->comment('coach\'s firstname');
            $table->string('lastname', 50)->comment('coach\'s lastname');
            $table->string('city', 50)->comment('coach\'s city')->nullable();
            $table->string('cin', 50)->comment('coach\'s cin')->nullable();
            $table->date('DOB')->comment('coach\'s date of birth')->nullable();
            $table->string('email', 50)->comment('coach\'s email id')->nullable();
            $table->string('address', 200)->comment('coach\'s address')->nullable();
            $table->boolean('status')->comment('0 for inactive , 1 for active')->nullable();
            $table->char('gender', 50)->comment('coach\'s gender')->nullable();
            $table->string('phone', 20)->comment('coach\'s contact number')->nullable();
            $table->string('emergency_contact', 20)->nullable();
            $table->string('health_issues', 50)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('account_id')->nullable();
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
        Schema::dropIfExists('coach');
    }
};
