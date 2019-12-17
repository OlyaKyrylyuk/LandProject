<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('number')->unique();
            $table->text('judge');
            $table->text('subject_claim');
            $table->integer('claim_id')->unsigned();
            $table->integer('defendant_id')->unsigned();
            $table->integer('worker_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('deals', function($table)
        {
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->foreign('defendant_id')->references('id')->on('defendants')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade');
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal');
    }
}
