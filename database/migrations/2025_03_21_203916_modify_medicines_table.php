<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn(['registered_qty', 'sold_qty', 'remain_qty', 'registered_date', 'expiry_date', 'selling_price', 'profit', 'remark']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->integer('registered_qty');
            $table->integer('sold_qty')->default(0);
            $table->integer('remain_qty');
            $table->date('registered_date');
            $table->date('expiry_date');
            $table->decimal('selling_price', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->string('remark')->nullable();
        });
    }
};
