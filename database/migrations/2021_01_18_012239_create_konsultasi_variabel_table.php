<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiVariabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi_variabel', function (Blueprint $table) {
            $table->foreignId('konsultasi_id')
            ->constrained('konsultasi')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('variabel_id')
            ->constrained('variabel')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('nilai')->nullable()->default(0);
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
        Schema::dropIfExists('konsultasi_variabel');
    }
}
