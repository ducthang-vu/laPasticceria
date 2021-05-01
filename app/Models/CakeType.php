<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CakeType extends Model
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
        return $this->hasMany('App\Models\Cake');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient')->withPivot('quantity');
    }

    /*
     * UTILITIES
     */
    /**
     * Getting a list of all slug
     *
     */
    static public function getAllSlugs() {
        return array_column(self::all('slug')->toArray(), 'slug');
    }

    static public function getIdBySlug($slug) {
        return self::where('slug', $slug)->first()['id'];
    }

    public function getIncredientsNameList() {
        return $this->ingredients->map(function ($model) {return $model->name;});
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

    /**
     * Getting the lowest price among the cake of the same type on sale.
     *
     */
    public function getPriceLowest() {
        if ($this->getQuantityOnSaleMadeTwoDaysAgo()) {
            return $this->getPriceFormatted(2);
        }
        if ($this->getQuantityOnSaleMadeYesterday()) {
            return $this->getPriceFormatted(1);
        }
        if ($this->getQuantityOnSaleMadeToday()) {
            return $this->getPriceFormatted();
        }
        return 0;
    }
    /**
     * Getting the quantity of cake on sale of the same cake_type. Cakes created more than three ago are not computed.
     *
     */
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

    /**
     * Getting the number of cake of the same cake_type created more than three days ago, but yet not deleted from the database.
     *
     */
    public function getQuantityWasted() {
        return $this->cakes->where('created_at', '<', Carbon::now()->subDays(3))->count();
    }
}
