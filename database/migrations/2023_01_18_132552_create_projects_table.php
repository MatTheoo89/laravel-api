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
        Schema::create('projects', function (Blueprint $table) {
            /*
                name
                slug
                client_name
                summary
                cover_image
            */
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 75)->unique();
            $table->string('client_name', 75);
            $table->text('summary')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('img_original_name')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
