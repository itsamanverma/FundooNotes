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
