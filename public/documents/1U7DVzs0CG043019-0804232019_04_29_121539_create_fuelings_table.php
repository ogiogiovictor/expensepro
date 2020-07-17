<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelings', function (Blueprint $table) {
            $table->increments('fueling_id');
            $table->string('office');
            $table->string('vehicle_number');
            $table->string('vehicle_driver');
            $table->string('comment');
            $table->string('cid');
            $table->string('mileage_km');
            $table->string('mileage_date');
            $table->string('mileage_time');
            $table->string('fuel_type');
            $table->string('fuel_level');
            $table->string('quantity_litre');
            $table->string('voucher_number');
            $table->string('voucher_date');
            $table->string('filling_station');
            $table->string('amount_litre');
            $table->string('total_amount');
            $table->string('fueliing_status');
            $table->string('unit_approval');
            $table->string('approval');
            $table->string('paid');
            $table->string('del');
            $table->string('logged_by');
            $table->string('created_by');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuelings');
    }
}
