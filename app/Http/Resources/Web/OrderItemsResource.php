<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
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
            'productName'=>$this->product->name,
            'productPrice'=>$this->product->price,
            'quantity'=>$this->quantity,
            'totalPrice'=>$this->quantity * $this->product->price,
        ];
    }
}
