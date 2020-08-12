<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cake_type;
use Carbon\Carbon;

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

    public function isWasted() {
        return Carbon::parse($this->created_at)->lessThan(Carbon::now()->subDays(3));
    }

    public function getTypeName() {
        return Cake_type::find($this->cake_type_id)->getNameCapitalized();
    }

    public function getPrice() {
        $created_at = Carbon::parse($this->created_at);
        $cakeType = Cake_type::find($this->cake_type_id);

        if ($created_at->greaterThan(Carbon::now()->subDays(1))) {
            return $cakeType->getPriceFormatted();
        }
        if ($created_at->greaterThan(Carbon::now()->subDays(2))) {
            return $cakeType->getPriceFormatted(1);
        }
        if ($created_at->greaterThan(Carbon::now()->subDays(3))) {
            return $cakeType->getPriceFormatted(2);
        }
        return 0;
    }
}
