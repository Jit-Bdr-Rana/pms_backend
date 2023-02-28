<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMysharesTable extends Migration
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
            $table->string('company', 100);
            $table->date('transaction_date')->nullable();
            $table->integer('debit_quantity');
            $table->integer('balance_after_transaction');
            $table->integer('credit_quantity')->nullable();
            $table->double('price', 8, 2);

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();

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
        // Schema::table('my_shares', function (Blueprint $table) {
        //     $table->dropForeign('company_id');
        //     $table->dropForeign('user_id');
        // });
        Schema::dropIfExists('companies');
        Schema::dropIfExists('my_shares');
        // Schema::dropIfExists('my_shares');
    }
}
