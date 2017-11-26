<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieClasseProfesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_classe_professeurs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('categorie_classes_id')->unsigned();
            $table->foreign('categorie_classes_id')
                  ->references('id')
                  ->on('categorie_classes')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('matieres_id')->unsigned();
            $table->foreign('matieres_id')
                  ->references('id')
                  ->on('matieres')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('professeurs_id')->unsigned();
            $table->foreign('professeurs_id')
                  ->references('id')
                  ->on('professeurs')
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
      Schema::table('categorie_classe_professeurs', function(Blueprint $table) {
            $table->dropForeign('professeurs_id_foreign');
            $table->dropForeign('categorie_classes_id_foreign');
            $table->dropForeign('matieres_id_foreign');
        });
        Schema::dropIfExists('categorie_classe_professeurs');
    }
}
