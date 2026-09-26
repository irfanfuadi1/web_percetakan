<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_queues', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_code', 50)->unique();

            $table->dateTime('invoice_date');

            $table->enum('payment_status', [
                'LUNAS',
                'BELUM LUNAS',
            ])->default('BELUM LUNAS');

            $table->string('customer_name', 150);

            $table->string('item', 150);

            $table->string('specification', 255);

            $table->string('file_path')->nullable();

            $table->unsignedTinyInteger('progress')->default(0);

            $table->enum('production_status', [
                'Menunggu',
                'Diproses',
                'Selesai',
            ])->default('Menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_queues');
    }
};