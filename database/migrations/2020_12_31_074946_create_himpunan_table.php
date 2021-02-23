<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHimpunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('himpunan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variabel_id')
            ->constrained('variabel')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nama');
            $table->text('domain');
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
        Schema::dropIfExists('himpunan');
    }
}
