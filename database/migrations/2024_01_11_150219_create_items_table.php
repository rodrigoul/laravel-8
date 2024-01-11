<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            
            $table->unsignedInteger('id', 10)->autoIncrement();

            $table->unsignedInteger('shopping_list_id')->nullable()->index();

            $table->string('name');
            $table->integer('quantity')->default(1);
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
