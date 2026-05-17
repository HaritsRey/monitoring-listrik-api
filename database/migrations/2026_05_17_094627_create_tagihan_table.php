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
        Schema::create('tagihan', function (Blueprint $table) {
        $table->id();

        $table->foreignId('pemakaian_id')
            ->constrained('pemakaian')
            ->onDelete('cascade');

        $table->integer('jumlah_tagihan');

        $table->enum('status', [
            'LUNAS',
            'BELUM_LUNAS'
        ]);

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
