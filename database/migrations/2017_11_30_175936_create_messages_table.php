<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

             $table->integer('conversations_id')->unsigned();
            $table->foreign('conversations_id')
                  ->references('id')
                  ->on('conversations')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');


            $table->integer('emmeteurs_id')->unsigned();
            $table->foreign('emmeteurs_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('fichiers_id')->unsigned()->nullable();
            $table->foreign('fichiers_id')
                  ->references('id')
                  ->on('fichiers')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->boolean('lu')->default(false);
            $table->datetime('date_lecture')->nullable();
            $table->text('contenu');
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
        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('emmeteurs_id_foreign');
            $table->dropForeign('conversations_id_foreign');
            $table->dropForeign('fichiers_id_foreign');
        });
        Schema::dropIfExists('messages');
    }
}
