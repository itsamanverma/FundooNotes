<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLablesNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lables_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uesrid');
            $table->unsignedInteger('noteid');
            $table->unsignedInteger('lableid');
            // $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('noteid')->references('id')->on('notes')->onDelelte('cascade');
            // $table->foreign('lableid')->references('id')->on('lables')->onDelete('cascade');
            $table->timestamps();
        });

        /**
         * to alter the existing table use the schema::table()
         * @update tables
         */
              Schema::table('lables_notes',function($table){
             $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('noteid')->references('id')->on('notes')->onDelelte('cascade');
             $table->foreign('lableid')->references('id')->on('lables')->onDelete('cascade');
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('lables_notes');
    // }
}
