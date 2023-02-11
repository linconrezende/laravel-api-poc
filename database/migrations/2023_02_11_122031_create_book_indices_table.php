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
        Schema::create('book_indices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('page');
            $table->unsignedBigInteger('book_id')->index();
            $table->unsignedBigInteger('index_id')->index()->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('index_id')->references('id')->on('book_indices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_indices');
    }
};
