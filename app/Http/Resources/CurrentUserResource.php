<?php

namespace App\Http\Resources;

use App\Http\Resources\BranchResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class CurrentUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "full_name" => $this->full_name,
            "username" => $this->username,
            "email" => $this->email,
            "address" => $this->address,
            "isActive" => $this->is_active,
            "role_id" => $this->role_id,
            // 'modules' => DB::table('role_accesses as ra')->select('m.id', 'm.name')->leftJoin('modules as m', 'ra.module_id', '=', 'm.id')->where('ra.role_id', $this->role_id)->where('ra.access', true)->get(),
            // "role"=>new RoleResource(Role::find($this->role_id)),
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}