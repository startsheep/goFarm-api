<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [
            "id" => $this->id,
            "category" => $this->category,
            "title" => $this->title,
            "slug" => $this->slug,
            "price" => $this->price,
            "description" => $this->description,
            "image" => url('storage/' . $this->image),
            "status" => $this->status,
            "created_by" => $this->user,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];

        return $result;
    }
}
