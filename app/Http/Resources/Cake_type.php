<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cake_type extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'currentPrice'=> $this->getPriceLowest(),
            'standardPrice' => $this->getPriceFormatted(),
            'image' => $this->image,
            'ingredients' => $this->getIncredientsNameList()
        ];
    }
}
