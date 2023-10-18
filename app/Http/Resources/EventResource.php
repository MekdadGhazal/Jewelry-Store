<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $customer_info = new CustomerResource(Customer::find($this->user_id));
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'card' => $this->card,
            'customer' => $customer_info,
        ];
    }
}
