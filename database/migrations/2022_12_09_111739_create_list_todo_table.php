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
        Schema::create('list_todo', function (Blueprint $table) {
            $table->id();
            $table->integer('todo_id')->unsigned()->index();
            $table->string('todo_title');
            $table->string('status_todo');
            $table->string('priority');
            $table->date('date');
            $table->text('discription')->nullable();
            $table->timestamps();
            // $table->foreign('todo_id')->references('id')->on('todo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_todo');
    }
};
