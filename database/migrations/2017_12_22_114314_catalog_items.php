<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('catalog_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->default(0);
            $table->integer('sort')->default(0);
            $table->boolean('status');
            $table->string('alias')->unique();
            $table->string('name');
            $table->string('h1')->nullable();
            $table->text('text')->nullable();
            $table->float('cost')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('catalog_groups')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_items');
    }
}
