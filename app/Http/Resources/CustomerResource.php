<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  $this['user']->id,
            'name' => $this['user']->name,
            'email' => $this['user']->email ,
            'phone' =>  $this['info']->phone,
            'card' =>  $this['info']->card,
            'address' =>[
                'country' =>  $this['info']->country,
                'city' =>  $this['info']->city,
                'street' =>  $this['info']->street,
            ],
        ];
    }
}
