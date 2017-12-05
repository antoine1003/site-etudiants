<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('users1_id')->unsigned();
            $table->foreign('users1_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('users2_id')->unsigned();
            $table->foreign('users2_id')
                  ->references('id')
                  ->on('users')
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
         Schema::table('conversations', function(Blueprint $table) {
            $table->dropForeign('users1_id_foreign');
            $table->dropForeign('users2_id_foreign');
        });
        Schema::dropIfExists('conversations');
    }
}
