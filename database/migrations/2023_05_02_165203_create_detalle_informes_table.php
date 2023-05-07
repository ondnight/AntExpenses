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
        Schema::create('detalle_informes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informes_id')->constrained()->onDelete('cascade');
            $table->foreignId('tickets_id')->constrained()->onDelete('cascade');
            $table->double('importe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_informes');
    }
};
