<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyShares extends Model
{
    use HasFactory;

    protected $table="my_shares";
    protected  $fillable=['company_name','transaction_date','debit_quantity','balance_after_transaction','credit_quantity','price'];
}
