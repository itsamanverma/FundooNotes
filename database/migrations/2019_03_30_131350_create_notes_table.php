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
            /* for identified the user make id coloum*/
            $table->bigIncrements('id');
            /* create the title of notes*/
            $table->string('title')->nullable();
            /* create the body of the notes*/
            $table->text('body')->nullable();
            /* create the reminder*/
            $table->string('reminder')->nullable();
            /*create the color of note */
            $table->string('color')->nullable();
            /*create the coloum if notes belongs to the particular user  */
            $table->unsignedInteger('usesid');
            /* create the colnum to noted the state of notes pinned or unpinned*/
            $table->boolean('pinned')->default(false);
            /* create the colnum for notes to getting id the note is archivevd or not*/
            $table->boolean('archived')->default(false);
            /*create the colnum for note the if it is delete or not*/
            $table->boolean('delete')->default(false);
            /* for saving index of the note */
            $table->unsignedInteger('index');

            /* makeing the userid foreign key */
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
