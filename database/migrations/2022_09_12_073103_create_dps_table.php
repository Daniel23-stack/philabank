<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dps_plan_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('per_installment', 18, 2);
            $table->integer('installment_interval');
            $table->string('interval_type', 10);
            $table->integer('total_installment');
            $table->integer('installment_completed');
            $table->decimal('interest_rate', 10, 2);
            $table->decimal('final_amount', 18, 2);
            $table->tinyInteger('status')->default(1)->comment('0 = Pending | 1 = Active | 2 = Matured | 3 = Closed');
            $table->date('next_installment_date');
            $table->date('matured_at')->nullable();
            $table->date('email_at')->nullable();
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
        Schema::dropIfExists('dps');
    }
}
