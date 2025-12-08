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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('c_id')->primary();
            // Datos del usuario
            $table->string('s_nombre', 100);
            $table->string('s_email', 150)->unique();
            $table->string('s_contrasenia');
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
        Schema::dropIfExists('usuarios');
    }
};
