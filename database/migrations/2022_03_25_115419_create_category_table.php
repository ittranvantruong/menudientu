<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->text('slug');
            // $table->string('en_name')->nullable();
            // $table->string('china_name')->nullable();
            $table->boolean('type')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('category');
    }
}
