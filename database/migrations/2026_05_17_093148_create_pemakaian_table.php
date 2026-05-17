<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemakaian', function (Blueprint $table) {
    $table->id();

     $table->foreignId('pelanggan_id')
          ->constrained('pelanggans')
          ->onDelete('cascade');

    $table->string('bulan');
    $table->integer('tahun');

    $table->integer('meter_awal');
    $table->integer('meter_akhir');
    $table->integer('total_kwh');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pemakaian');
    }
};