<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResource extends JsonResource
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
            'id'=>$this->id,
            'user_name'=>$this->user->name,
            'subscription_name'=>$this->subscription->name,
            'status'=>$this->status,
            'start_date'=>$this->created_at->format('Y-m-d'),
            'end_date'=>$this->end_date,
            'auto_renew'=>$this->auto_renew,
        ];
    }
}
