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
        //
        Schema::create('therapists', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->default(' ');
            $table->string('lastname')->default(' ');
            $table->string('password')->default(' ');
            $table->string('email')->default(' ')->unique();
            $table->integer('phonenumber')->default(0);
            $table->string('myfile')->default('NO CV');
            $table->string('approval')->default('pending');

           
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
        Schema::dropIfExists('therapists');
    }
};
