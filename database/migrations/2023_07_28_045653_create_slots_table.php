<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('token');
            $table->boolean('is_booked')->default(false)->nullable();
            $table->dateTime('booking_date')->default(null)->nullable();
            $table->enum('status_pakai', [0, 1, 2, 3])->default('0')->nullable();
            $table->enum('status', [0, 1])->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('slots');
    }
}
