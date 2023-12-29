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
        Schema::create('stoks', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
            $table->id();
            $table->string('nama_produk');
            $table->decimal('harga_produk', 10, 2);
            $table->text('informasi_produk');
            $table->text('deskripsi_produk');
            $table->string('foto')->nullable();
            $table->integer('jumlah_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stoks', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
