<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            //for id 
            $table->increments('id');
            //title of note 
            $table->string('title')->nullable();
            //body of the note 
            $table->text('body')->nullable();
            //reminder of the note
            $table->string('reminder')->nullable();
            //color of note
            $table->string('color')->nullable();
            //user id if note it belongs to 
            $table->unsignedInteger('userid');
            //state of the note pinned or unpinned
            $table->boolean('ispinned')->default(0);
            //getting if the note is archived or not 
            $table->boolean('isarchived')->default(0);
            //for idf note is delete or not
            $table->boolean('istrash')->default(0);
            //for saving the index of the note 
            $table->unsignedInteger('index');
            //making the userid foreign key
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
                
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
        Schema::dropIfExists('notes');
    }
}
