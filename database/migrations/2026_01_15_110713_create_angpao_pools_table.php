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
    Schema::create('angpao_pools', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama event, misal: "Angpao Kantor"
        $table->decimal('total_amount', 15, 2); // Total budget angpao
        $table->integer('total_slots'); // Total kuota orang
        $table->integer('remaining_slots'); // Sisa kuota
        $table->enum('status', ['active', 'closed'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angpao_pools');
    }
};
