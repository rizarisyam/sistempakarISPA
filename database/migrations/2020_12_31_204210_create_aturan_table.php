<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keputusan_id')
            ->constrained('keputusan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('kode')->unique();
            $table->integer('mb');
            $table->integer('md');
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
        Schema::dropIfExists('aturan');
    }
}
