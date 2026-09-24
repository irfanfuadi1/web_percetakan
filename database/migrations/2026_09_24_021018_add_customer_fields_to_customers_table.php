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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('code', 50)->unique()->after('id');

            $table->string('name', 150)->after('code');

            $table->enum('customer_type', ['Member', 'Umum'])
                ->default('Umum')
                ->after('name');

            $table->string('phone', 30)
                ->nullable()
                ->after('customer_type');

            $table->text('address')
                ->nullable()
                ->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn([
                'code',
                'name',
                'customer_type',
                'phone',
                'address',
            ]);
        });
    }
};
