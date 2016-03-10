<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            $table->string('name');
            $table->string('ingredient');
            $table->string('dosage');
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
        Schema::drop('meds');
    }
}
