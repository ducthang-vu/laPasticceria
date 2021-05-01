<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cake_type;
use Carbon\Carbon;

class Cake extends Model
{
    use HasFactory;
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
        return CakeType::find($this->cake_type_id)->getNameCapitalized();
    }

    public function getPrice() {
        $created_at = Carbon::parse($this->created_at);
        $cakeType = CakeType::find($this->cake_type_id);

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
