<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakeTypeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cake_type_ingredient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_type_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->smallInteger('quantity');
            $table->timestamps();

            // relationships
            $table->foreign('cake_type_id')
                ->references('id')
                ->on('cake_types')
                ->onDelete('cascade');
            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cake_type_ingredient');
    }
}
