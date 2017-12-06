<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->index();
            $table->boolean('status');
            $table->string('alias')->unique();
            $table->string('name');
            $table->string('h1')->nullable();
            $table->string('autogenerate_items_name')->nullable();
            $table->text('text')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('catalog_groups');
    }
}
