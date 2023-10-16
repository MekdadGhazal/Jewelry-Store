<?php

namespace App\Http\Resources;

use App\Models\Country;
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
            'id' =>  $this->id,
            'name' => $this->name,
            'email' => $this->email ,
            'phone' =>  $this->phone,
            'card' =>  $this->card,
            'address' =>[
                'country' =>  Country::find($this->country)->name,
                'city' =>  $this->city,
                'street' =>  $this->street,
            ],
        ];
    }
}
