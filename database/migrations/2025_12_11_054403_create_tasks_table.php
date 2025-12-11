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
            $table->timestamps();
            $table->string('title',150);
            $table->text('description',300)->nullable();
            $table->foreignUuid('c_id_status')->constrained('status')->onDelete('restrict');
            $table->foreignUuid('c_id_priority')->constrained('priorities')->onDelete('restrict');

            // Auditoría
            $table->uuid('c_usu_alta')->nullable();
            $table->uuid('c_usu_actualiza')->nullable();
            $table->timestamp('f_alta')->useCurrent();
            $table->timestamp('f_actualiza')->useCurrent()->useCurrentOnUpdate();
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
