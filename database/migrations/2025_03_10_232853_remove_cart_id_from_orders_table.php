<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['cart_id']); // Drop foreign key first
            $table->dropColumn('cart_id'); // Then drop the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Restore cart_id if needed
        });
    }
};
