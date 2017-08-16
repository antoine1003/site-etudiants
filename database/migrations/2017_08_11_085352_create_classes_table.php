<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_classe')->unique();
            $table->integer('etats_validations_id')->unsigned();
            $table->foreign('etats_validations_id')
                  ->references('id')
                  ->on('etats_validations')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
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
        Schema::table('classes', function(Blueprint $table) {

            $table->dropForeign('classes_etats_validations_id_foreign');

        });
        Schema::dropIfExists('classes');
    }
}
