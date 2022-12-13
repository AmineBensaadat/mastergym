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
       Schema::table('gyms', function (Blueprint $table) {
            $table->longText('desc')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->boolean('is_main')->nullable()->change();
            $table->string('phone')->nullable()->change();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gyms', function (Blueprint $table) {
            Schema::dropIfExists('gyms');
        });
    }
};
