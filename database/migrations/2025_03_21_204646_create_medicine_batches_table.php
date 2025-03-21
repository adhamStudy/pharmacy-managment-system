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
        Schema::create('medicine_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade');
            $table->string('batch_code')->unique();
            $table->integer('registered_qty');
            $table->integer('sold_qty')->default(0);
            $table->integer('remain_qty');
            $table->date('registered_date');
            $table->date('expiry_date');
            $table->decimal('selling_price', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('medicine_batches');    }
};
