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
        Schema::create('nepse_data', function (Blueprint $table) {
            $table->id();
            $table->string('security_name', 100);
            $table->string('open_price', 100);
            $table->string('high_price', 100);
            $table->string('low_price', 100);
            $table->string('close_price', 100);
            $table->integer('total_traded_quantity')->nullable();
            $table->string('total_traded_value', 100)->nullable();
            $table->string('previous_day_close_price', 100)->nullable();
            $table->string('fifty_two_weeks_high', 100)->nullable();
            $table->string('fifty_two_weeks_low', 100)->nullable();
            $table->integer('total_trades')->nullable();
            $table->string('average_traded_value', 100)->nullable();
            $table->string('market_capitalization', 100)->nullable();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullable();

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
        Schema::dropIfExists('nepse_data');
    }
}
