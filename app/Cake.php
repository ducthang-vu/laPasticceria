<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cake_type;

class Cake extends Model
{
    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Cake_type');
    }

    public function getType() {
        return Cake_type::find($this->cake_type_id)->getNameCapitalized();
    }

    public function getPrice() {
        return Cake_type::find($this->cake_type_id)->getPriceFormatted();
    }
}
