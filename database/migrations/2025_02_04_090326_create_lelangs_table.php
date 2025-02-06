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
        Schema::create('lelangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->date('tanggal_lelang');
            $table->date('tanggal_tutup_lelang');
            $table->integer('harga_akhir');
            $table->integer('id_user')->nullable();
            $table->integer('id_petugas');
            $table->integer('id_kategori');
            $table->enum('status',['dibuka', 'ditutup'])->default('ditutup');
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('masyarakats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id')->on('petugas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelangs');
    }
};
