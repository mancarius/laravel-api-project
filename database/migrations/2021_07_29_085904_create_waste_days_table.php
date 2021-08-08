<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_days', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignId('day_id')
                ->constrained('days')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('waste_id')
                ->constrained('wastes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->time('pick_up_time_start');
            $table->time('pick_up_time_end');
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
        Schema::dropIfExists('waste_days');
    }
}
