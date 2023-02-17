<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VariationResource;
use App\Models\Product;

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
            Product::ATTR_PK => $this->getID(),
            Product::ATTR_NAME => $this->getName(),
            Product::ATTR_REFERENCE => $this->getReference(),
            Product::ATTR_DESCRIPTION => $this->getDescription(),
            Product::ATTR_PRICE => $this->getPrice(),
            Product::RELATION_VARIATIONS => VariationResource::collection($this->getVariations())
        ];
    }
}
