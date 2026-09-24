<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('code', 50)->unique()->after('id');
            $table->string('name', 150)->after('code');
            $table->string('product', 150)->after('name');
            $table->string('phone', 30)->nullable()->after('product');
            $table->text('address')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn([
                'code',
                'name',
                'product',
                'phone',
                'address',
            ]);
        });
    }
};
