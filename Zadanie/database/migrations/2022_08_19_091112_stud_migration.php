<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::rename('stud_models', 'Students');
        Schema::create('stud_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stud_models');
        Schema::dropIfExists('subjects');
    }
}
