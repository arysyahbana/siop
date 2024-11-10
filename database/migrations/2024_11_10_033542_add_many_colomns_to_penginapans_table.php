<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE penginapans CHANGE lokasi id_lokasi VARCHAR(10) NULL");
        DB::table('penginapans')->update(['id_lokasi' => null]);
        Schema::table('penginapans', function (Blueprint $table) {
            $table->text('maps')->after('id_lokasi')->nullable();
            $table->string('jenis_penginapan')->after('maps')->nullable();
            $table
                ->enum('wahana', ['Ada', 'Tidak Ada'])
                ->after('jenis_penginapan')
                ->default('Tidak Ada')
                ->nullable();
            $table
                ->enum('outbound', ['Ada', 'Tidak Ada'])
                ->after('wahana')
                ->default('Tidak Ada')
                ->nullable();
            $table
                ->enum('kafe', ['Ada', 'Tidak Ada'])
                ->after('outbound')
                ->default('Tidak Ada')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penginapans', function (Blueprint $table) {
            //
        });
    }
};
