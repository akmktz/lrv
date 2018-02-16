<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CatalogSpecificationsValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_specifications_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specification_id')->unsigned()->index();
            $table->boolean('status');
            $table->integer('sort')->default(0);
            $table->string('alias')->unique();
            $table->string('name');
            $table->timestamps();

            $table->foreign('specification_id')->references('id')->on('catalog_specifications')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_specifications_values');
    }
}
