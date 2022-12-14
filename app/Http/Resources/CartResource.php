<?php

namespace App\Http\Resources;

use App\Models\ProductVariantGroup;
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
            "id"=>$this->id,
            "total"=>$this->total,
            "cart_detail"=>CartItemResource::collection($this->cart->load("additions"))
        ];
        //return parent::toArray($request);
    }
}
