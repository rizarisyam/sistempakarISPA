<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturanKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aturan_konsultasi', function (Blueprint $table) {
            $table->foreignId('konsultasi_id')->constrained('konsultasi')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('aturan_id')->constrained('aturan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->double('nilai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aturan_konsultasi');
    }
}
