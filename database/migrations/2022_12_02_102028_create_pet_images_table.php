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
        Schema::create('pet_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id');
            $table->string('filename');
            $table->timestamps();

            $table->foreign('pet_id')
                ->references('id')
                ->on('pets')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_images');
    }
};
