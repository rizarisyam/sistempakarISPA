<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturanHimpunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aturan_himpunan', function (Blueprint $table) {
            $table->foreignId('aturan_id')
            ->constrained('aturan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('himpunan_id')->nullable()->constrained('himpunan')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('aturan_himpunan');
    }
}
