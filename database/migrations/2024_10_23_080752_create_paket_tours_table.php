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
        Schema::create('paket_tours', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('id_objek_wisata');
            $table->string('id_penginapan');
            $table->string('id_pemilik');
            $table->integer('harga');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_tours');
    }
};
