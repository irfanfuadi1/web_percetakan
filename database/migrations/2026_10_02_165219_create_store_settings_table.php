<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();

            $table->string('store_name', 150)
                ->default('Gemiprint');

            $table->text('address')
                ->nullable();

            $table->string('phone', 30)
                ->nullable();

            $table->string('receipt_logo')
                ->nullable();

            $table->enum('receipt_paper_size', [
                '80mm',
                '58mm',
            ])->default('80mm');

            $table->text('receipt_footer')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};