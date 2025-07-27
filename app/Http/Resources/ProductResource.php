<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "id"=>$this->id ,
            "name"=>$this->name ,
            "description"=>$this->description ,
            "image"=>$this->image ,
            "audio_file"=>$this->audio_file ,
            "pdf_file"=>$this->book_file ,
            "price"=>$this->price ,
            "author"=>$this->author ,
            "quantity"=>$this->stock_quantity ,
            "publisher_year"=>$this->publisher_year ,
            "category"=>$this->category->name,
        ];
    }
}
