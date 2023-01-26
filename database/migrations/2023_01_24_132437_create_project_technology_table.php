<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_technology', function (Blueprint $table) {

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnDelete();

            $table->unsignedBigInteger('nomecolonna_id');
            $table->foreign('nomecolonna_id')
                    ->references('id')
                    ->on('tabellaDiRiferimento')
                    ->cascadeOnDelete(); // in caso di eliminazione cancella tutto quello collegato
                
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
        Schema::dropIfExists('project_technology');
    }
};
