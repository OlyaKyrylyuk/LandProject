<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('number')->nullable()->unique();
            $table->text('reason');
            $table->integer('user_id')->unsigned();//зв'язок з таблицею заява
            $table->timestamps();
        });
        Schema::table('claims', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
