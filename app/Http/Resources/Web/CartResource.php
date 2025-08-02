<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'image'=>$this->product->image,
            'name'=>$this->product->name,
            'quantity'=>$this->quantity,
            'price'=>$this->product->price,
            'totalPrice'=>$this->quantity * $this->product->price,
        ];
    }
}
