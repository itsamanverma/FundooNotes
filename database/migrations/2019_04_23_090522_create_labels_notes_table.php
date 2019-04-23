<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userid');
            $table->unsignedInteger('noteid');
            $table->unsignedInteger('labelid');
            $table->timestamps();
        });

        Schema::table('labels_notes', function($table) {
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('noteid')->references('id')->on('notes')->onDelete('cascade');
            $table->foreign('labelid')->references('id')->on('labels')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels_notes');
    }
}
