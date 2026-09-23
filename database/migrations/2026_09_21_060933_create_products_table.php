<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->string('supplier_category', 150);

            $table->integer('stock')->default(0);

            $table->string('unit', 50);

            $table->decimal('purchase_price', 15, 2)
                ->default(0);

            $table->decimal('selling_price', 15, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
