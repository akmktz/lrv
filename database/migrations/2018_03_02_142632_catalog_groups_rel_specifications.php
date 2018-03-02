<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogGroupsRelSpecifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_groups_rel_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->integer('specification_id')->unsigned()->index();
            $table->unique(['group_id', 'specification_id']);

            $table->foreign('group_id')->references('id')->on('catalog_groups')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('catalog_groups_rel_specifications');
    }
}
