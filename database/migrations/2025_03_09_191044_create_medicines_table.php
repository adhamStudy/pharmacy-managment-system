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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('category');
            $table->integer('registered_qty');
            $table->integer('sold_qty')->default(0);
            $table->integer('remain_qty');
            $table->date('registered_date');
            $table->date('expiry_date');
            $table->text('remark')->nullable();
            $table->decimal('selling_price', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
