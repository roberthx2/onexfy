<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VariationResource;
use App\Models\Variation;

class VariationResource extends JsonResource
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
            Variation::ATTR_PK => $this->getID(),
            Variation::ATTR_REFERENCE => $this->getReference(),
            Variation::ATTR_DESCRIPTION => $this->getDescription(),
            Variation::ATTR_PRICE => $this->getPrice(),
            Variation::ATTR_PRODUCT_ID => $this->getProductId()
        ];
    }
}
