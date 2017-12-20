<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eventcategories_id')->unsigned();
            $table->foreign('eventcategories_id')
                ->references('id')
                ->on('eventcategories')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            //Met l'évènement en plannifié
            $table->integer('eventetats_id')->unsigned()->default(4);
            $table->foreign('eventetats_id')
                ->references('id')
                ->on('eventetats')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('title');
            $table->boolean('all_day')->default(false);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('comment')->nullable();
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('eventcategories_id_foreign');
            $table->dropForeign('eventetats_id_foreign');
        });
        Schema::dropIfExists('events');
    }
}
