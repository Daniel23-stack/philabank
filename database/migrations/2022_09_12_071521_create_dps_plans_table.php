<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsPlansTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dps_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->bigInteger('currency_id')->unsigned();
            $table->decimal('per_installment', 18, 2);
            $table->integer('installment_interval');
            $table->string('interval_type', 10);
            $table->integer('total_installment');
            $table->decimal('interest_rate', 10, 2);
            $table->decimal('final_amount', 18, 2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currency')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('dps_plans');
    }
}
