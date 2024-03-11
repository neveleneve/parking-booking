<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_id');
            $table->integer('nominal');
            $table->string('snap_token');
            $table->enum('status', [0, 1, 2, 3])->default('0');
            // 0 => initiate
            // 1 => on progress
            // 2 => error
            // 3 => done
            $table->enum('transaction_status', [
                'initiate',
                'authorize',
                'capture',
                'settlement',
                'deny',
                'pending',
                'cancel',
                'refund',
                'partial_refund',
                'chargeback',
                'partial_chargeback',
                'expire',
                'failure',
            ])->default('initiate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pembayarans');
    }
}
