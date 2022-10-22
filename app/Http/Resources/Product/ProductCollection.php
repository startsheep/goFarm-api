<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [];

        foreach ($this as $product) {
            $result[] = [
                "id" => $product->id,
                "category" => $product->category,
                "title" => $product->title,
                "slug" => $product->slug,
                "price" => $product->price,
                "description" => $product->description,
                "image" => url('storage/' . $product->image),
                "status" => $product->status,
                "created_by" => $product->user,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at
            ];
        }

        return $result;
    }
}
