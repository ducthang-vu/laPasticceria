<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CakeTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'name' => $this->name,
            'currentPrice'=> $this->getPriceLowest(),
            'standardPrice' => $this->getPriceFormatted(),
            'image' => $this->image,
            'quantity' => $this->getQuantityOnSale(),
            'ingredients' => $this->getIncredientsNameList()
        ];
    }
}
