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
        Schema::create('members', function (Blueprint $table) {
            $table->id()->comment('Unique Record Id for system');
            $table->string('name', 50)->comment('member\'s name');
            $table->date('DOB')->comment('member\'s date of birth');
            $table->string('email', 50)->unique('email')->comment('member\'s email id');
            $table->string('address', 200)->comment('member\'s address');
            $table->boolean('status')->comment('0 for inactive , 1 for active');
            $table->char('gender', 50)->comment('member\'s gender');
            $table->string('contact', 11)->unique('contact')->comment('member\'s contact number');
            $table->string('emergency_contact', 11);
            $table->string('health_issues', 50);
            $table->string('source', 50);
            $table->timestamps();
            $table->integer('created_by')->unsigned()->index('FK_members_users_1');
            $table->integer('updated_by')->unsigned()->index('FK_members_users_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
