<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->user;
        return parent::toArray($request);
    }
}
