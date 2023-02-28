<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NepseData extends Model
{
    use HasFactory;

    protected $fillable=['security_name','open_price','high_price','low_price','close_price','total_traded_quantity','total_traded_value','previous_day_close_price','fifty_two_weeks_high','fifty_two_weeks_low','total_trades','average_traded_values','market_capitalization','company_id'];
}
