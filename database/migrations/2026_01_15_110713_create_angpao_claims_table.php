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
       Schema::create('angpao_claims', function (Blueprint $table) {
    $table->id();
    $table->foreignId('angpao_pool_id')->constrained();
    $table->string('claimed_by'); // Nama atau ID User
    $table->decimal('amount', 15, 2); // Jumlah yang didapat
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angpao_claims');
    }
};
