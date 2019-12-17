<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table)
        {
            $table->increments('id');
            $table->enum('type', ['перша', 'друга','третя']);
            $table->datetime('deal_start');
            $table->datetime('deal_end');
            $table->text('decision')->nullable();;
            $table->integer('deal_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('steps', function($table)
        {
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steps');
    }
}
