cla<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('classes_id')->unsigned();
            $table->foreign('classes_id')
                  ->references('id')
                  ->on('classes')
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
        Schema::table('eleves', function(Blueprint $table) {

            $table->dropForeign('eleves_classes_id_foreign');
            $table->dropForeign('eleves_users_id_foreign');

        });
        Schema::dropIfExists('eleves');
    }
}
