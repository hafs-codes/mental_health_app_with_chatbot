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
        Schema::create('therapy_sessions', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('therapistemail');
            $table->string('studentemail');
            $table->string('studentname');
            $table->string('therapistname');
            $table->string( 'studentphonenumber' );
            $table->string( 'therapistphonenumber');
            $table->string('date');
            $table->string('completion')->default('pending');
          
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
        Schema::dropIfExists('therapy_sessions');
    }
};
