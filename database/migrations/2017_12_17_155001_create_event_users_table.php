<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->integer('events_id')->unsigned();
            $table->foreign('events_id')
                  ->references('id')
                  ->on('event')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->boolean('creator')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('event_users', function(Blueprint $table) {
            $table->dropForeign('users_id_foreign');
            $table->dropForeign('events_id_foreign');
        });
        Schema::dropIfExists('event_users');
    }
}
