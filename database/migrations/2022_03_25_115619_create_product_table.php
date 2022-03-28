<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->text('name');
            // $table->text('en_name')->nullable();
            // $table->text('china_name')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('slug');
            $table->double('price')->nullable();
            $table->double('price_large')->nullable();
            $table->float('quantity')->nullable();
            $table->char('unit')->nullable();
            $table->text('avatar')->nullable();
            $table->longText('desc')->nullable();
            // $table->longText('en_desc')->nullable();
            // $table->longText('china_desc')->nullable();
            $table->boolean('status')->defaultValue(1);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('category')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
