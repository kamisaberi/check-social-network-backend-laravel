<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->bigInteger('start_date');
            $table->bigInteger('duration');
            $table->integer('creator')->unsigned();
            $table->integer('parent')->unsigned();
            $table->integer('priority')->unsigned();
            $table->integer('group')->unsigned();
            $table->integer('exact_time');
            $table->tinyInteger('can_continue_after_timeout');
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
        Schema::dropIfExists('duties');
    }
}
