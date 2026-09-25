<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cash_accounts', function (Blueprint $table) {
            $table->string('name', 150)->after('id');

            $table->enum('type', [
                'Kas',
                'Bank',
                'E-Wallet'
            ])->after('name');

            $table->decimal('balance', 15, 2)
                ->default(0)
                ->after('type');

            $table->text('description')
                ->nullable()
                ->after('balance');
        });
    }

    public function down(): void
    {
        Schema::table('cash_accounts', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'type',
                'balance',
                'description',
            ]);
        });
    }
};