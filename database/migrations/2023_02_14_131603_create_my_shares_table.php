<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMySharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_shares', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->date('transaction_date');
            $table->bigInteger('debit_quantity');
            $table->bigInteger('balance_after_transaction');
            $table->bigInteger('credit_quantity');
            $table->decimal('price', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('my_shares');
    }
}
