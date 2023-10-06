<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'karat' => $this->karat,
            'category' => $this->category,
            'closed_image' => asset($this->closed_image),
            'far_image' => asset($this->far_image),
            'price' => $this->price,
            'created_at' => isset($this->created_at)? $this->created_at->diffForHumans(): null,
        ];
    }
}
