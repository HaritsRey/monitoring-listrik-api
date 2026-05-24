<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meter_listrik', function (Blueprint $table) {

            $table->foreignId('tarif_id')
                  ->after('pelanggan_id')
                  ->constrained('tarifs')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('meter_listrik', function (Blueprint $table) {

            $table->dropForeign(['tarif_id']);
            $table->dropColumn('tarif_id');

        });
    }
};