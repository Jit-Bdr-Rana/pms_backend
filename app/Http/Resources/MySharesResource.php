<?php

namespace App\Http\Resources;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class MySharesResource extends JsonResource
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
                'transaction_date' => $this->transaction_date,
                'company_name' => $this->company_name,
                'share_type' => $this->share_type,
                'debit_quantity' => $this->debit_quantity,
                'balance_after_transaction' => $this->balance_after_transaction,
                'credit_quantity' => $this->credit_quantity,
                'trans_type' => $this->trans_type,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'company' => CompanyResource::make(Company::where('id', $this->company_id)->first()),
                'user' => User::where('id', $this->user_id)->first(),

            ];
    }
}