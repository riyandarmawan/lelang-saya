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
        Schema::create('history_lelangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_lelang');
            $table->integer('id_barang');
            $table->integer('id_user');
            $table->integer('penawaran_harga');
            $table->timestamps();

            $table->foreign('id_lelang')->references('id')->on('lelangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('masyarakats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lelangs');
    }
};
