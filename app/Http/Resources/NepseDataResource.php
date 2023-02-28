<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

class NepseDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'securityName'=>$this->security_name,
                'open_price'=>$this->open_price,
                'high_price'=>$this->high_price,
                'low_price'=>$this->low_price,
                'close_price'=>$this->close_price,
                'total_traded_quantity'=>$this->total_traded_quantity,
                'total_traded_value'=>$this->total_traded_value,
                'previous_day_close_price'=>$this->previous_day_close_price,
                'fifty_two_weeks_high'=>$this->fifty_two_weeks_high,
                'fifty_two_weeks_low'=>$this->fifty_two_weeks_low,
                'average_traded_value'=>$this->average_traded_value,
                'market_capitalization'=>$this->market_capitalization,

                'company'=>Company::where('id',$this->company_id)->first(),
                'company_id'=>$this->company_id


        ];
    }
}
