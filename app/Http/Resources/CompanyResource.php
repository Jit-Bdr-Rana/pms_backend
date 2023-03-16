<?php

namespace App\Http\Resources;

use App\Models\NepseData;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
                'id' => $this->id,
                'symbol' => $this->symbol,
                'name' => $this->name,
                'sector' => $this->sector,
                'nepse' => NepseData::where('company_id', $this->id)->first()
            ];
    }
}