<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            
            $table->dropColumn('quantity');
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('shopping_list_id')->nullable();
            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists')->onDelete('cascade');
        });
    }
}
