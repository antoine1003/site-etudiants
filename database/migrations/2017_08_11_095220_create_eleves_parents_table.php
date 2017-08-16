<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevesParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves_parents', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('eleves_id')->unsigned();
            $table->integer('parents_id')->unsigned();
            $table->foreign('eleves_id')->references('id')->on('eleves')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

            $table->foreign('parents_id')->references('id')->on('parents')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eleves_parents', function(Blueprint $table) {
            $table->dropForeign('eleves_parents_parents_id_foreign');
            $table->dropForeign('eleves_parents_eleves_id_foreign');
        });


        Schema::drop('eleves_parents');
    }
}
