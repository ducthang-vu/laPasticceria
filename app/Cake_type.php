<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Int_;

class Cake_type extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
    ];

    /**
     * Routes parameter is modified from {id} to {slug}.
     *
     * @return void
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cakes()
    {
        return $this->hasMany('App\Cake');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('quantity');
    }

    /*
     * UTILITIES
     */

    static public function getAllSlugs() {
        return array_column(self::all('slug')->toArray(), 'slug');
    }

    static public function getIdBySlug($slug) {
        return self::where('slug', $slug)->first()['id'];
    }

    public function getNameCapitalized() {
        return ucfirst($this->name);
    }

    public function getPriceAsNumber($discountDays=null) {
        $standardPrice = $this->price / 100;
        return $discountDays ? $standardPrice * config('cakeDiscounts')[$discountDays] : $standardPrice;
    }

    public function getPriceFormatted($discountDays=null) {
        return str_replace(".",",", number_format($this->getPriceAsNumber($discountDays), 2));
    }

    public function getQuantityOnSale() {
        return $this->cakes->where('created_at', '>=', Carbon::now()->subDays(3))->count();
    }

    public function getQuantityOnSaleMadeToday() {
        return $this->cakes->where('created_at', '>=', Carbon::now()->subDays(1))->count();
    }

    public function getQuantityOnSaleMadeYesterday() {
        return $this->cakes
            ->where('created_at', '>=', Carbon::now()->subDays(2))
            ->where('created_at', '<', Carbon::now()->subDays(1))
            ->count();
    }
    public function getQuantityOnSaleMadeTwoDaysAgo() {
        return $this->cakes
            ->where('created_at', '>=', Carbon::now()->subDays(3))
            ->where('created_at', '<', Carbon::now()->subDays(2))
            ->count();
    }

    public function getQuantityWasted() {
        return $this->cakes->where('created_at', '<', Carbon::now()->subDays(3))->count();
    }
}
