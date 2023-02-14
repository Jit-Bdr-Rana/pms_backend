<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNepseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nepse__data', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('symbol', 100);
            $table->string('security_name', 100);
            $table->decimal('open_price', $precision = 8, $scale = 2);
            $table->decimal('high_price', $precision = 8, $scale = 2);
            $table->decimal('low_price', $precision = 8, $scale = 2);
            $table->decimal('close_price', $precision = 8, $scale = 2);
            $table->bigInteger('total_traded_quantity');
            $table->decimal('total_traded_value', $precision = 8, $scale = 2);
            $table->decimal('previous_day_close_price', $precision = 8, $scale = 2);
            $table->decimal('fifty_two_weeks_high', $precision = 8, $scale = 2);
            $table->decimal('fifty_two_weeks_low', $precision = 8, $scale = 2);
            $table->bigInteger('total_trades');
            $table->decimal('market_capitalization', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('nepse__data');
    }
}
