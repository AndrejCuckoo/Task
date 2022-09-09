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
        Schema::create('stud_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
        });

        Schema::create('conn', function (Blueprint $table) {
            $table->id();
            $table->string('StudId');
            $table->string('SubjectId');
            $table->string('Grade')->nullable();
            $table->string('KM_Num')->nullable();
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
        Schema::dropIfExists('conn');
    }
}
