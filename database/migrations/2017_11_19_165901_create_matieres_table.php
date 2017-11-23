<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_matiere')->nullable(false);
            $table->integer('etats_validations_id')->unsigned();
            $table->foreign('etats_validations_id')
                  ->references('id')
                  ->on('etats_validations')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
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
        Schema::table('matieres', function(Blueprint $table) {

            $table->dropForeign('etats_validations_id_foreign');
        });
        Schema::dropIfExists('matieres');
    }
}
