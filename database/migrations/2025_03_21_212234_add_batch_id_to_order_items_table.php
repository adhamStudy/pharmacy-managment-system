<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBatchIdToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Add batch_id column
            $table->unsignedBigInteger('batch_id')->nullable()->after('medicine_id');
            
            // Add foreign key constraint
            $table->foreign('batch_id')
                  ->references('id')
                  ->on('medicine_batches')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['batch_id']);
            
            // Then drop the column
            $table->dropColumn('batch_id');
        });
    }
}