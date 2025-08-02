<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoritesResource extends JsonResource
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
            'productImage'=>$this->product->image,
            'productName'=>$this->product->name,
            'productPrice'=>$this->product->price,
            'productCreate_at'=>$this->product->created_at,
            'productQuantity'=>$this->product->stock_quantity,
        ];
    }
}
