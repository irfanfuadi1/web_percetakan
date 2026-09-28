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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_code', 50)->unique();

            $table->dateTime('order_date');

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->restrictOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            $table->decimal('quantity', 15, 2)->default(1);

            $table->string('unit', 50);

            $table->decimal('price', 15, 2)->default(0);

            $table->decimal('total', 15, 2)->default(0);

            $table->decimal('paid', 15, 2)->default(0);

            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Dibatalkan',
            ])->default('Menunggu');

            $table->string('specification', 255)->nullable();

            $table->string('file_path')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
