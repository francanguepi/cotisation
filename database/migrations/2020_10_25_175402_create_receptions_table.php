<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cotisation_id');
            $table->integer('membre_id');
            $table->date('jour_reception');
            $table->integer('montant_reçu');
            $table->boolean('recu')->default(0);
            $table->boolean('calendrier')->default(0);

            /*$table->unsignedBigInteger('cotisation_id');
            $table->foreign('cotisation_id')
                ->references('id')
                ->on('cotisations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->unsignedBigInteger('membre_id');
            $table->foreign('membre_id')
                ->references('id')
                ->on('membres')
                ->onDelete('cascade')
                ->onUpdate('cascade');*/



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotisation_membre_reception');
    }
}
