<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeanceCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seance_cotisations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cotisation_id');
            $table->integer('membre_id');
            $table->date('date_jour');
            $table->integer('montant_cotise');
            $table->boolean('penalite')->default(0);
            $table->boolean('cotise')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seance_cotisations');
    }
}
