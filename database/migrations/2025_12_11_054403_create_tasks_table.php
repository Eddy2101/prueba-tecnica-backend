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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('c_id')->primary();
            $table->string('title',150);
            $table->text('description',300)->nullable();
            $table->string('c_id_status',3)->constrained('status')->onDelete('restrict');
            $table->string('c_id_priority',3)->constrained('priorities')->onDelete('restrict');

            // Auditoría
            $table->uuid('c_usu_alta')->nullable();
            $table->uuid('c_usu_actualiza')->nullable();
            $table->timestamp('f_alta')->useCurrent();
            $table->timestamp('f_actualiza')->nullable();;
            $table->string('c_activo',1)->default('S');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
