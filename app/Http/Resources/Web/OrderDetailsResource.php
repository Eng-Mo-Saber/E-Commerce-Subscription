<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'userName'=>$this->user->name,
            'userEmail'=>$this->user->email,
            'userPhone'=>$this->user->phone,
            'address'=>$this->address,
            'totalPrice'=>$this->total_price,
        ];
    }
}
