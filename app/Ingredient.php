<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cakeTypes()
    {
        return $this->belongsToMany('App\Cake_type')->withPivot('quantity');
    }

    /* UTILITIES */
    static public function getAllNamesSlug() {
        return self::all()->map(function($ingredient) {return $ingredient->getSlug();})->toArray();
    }

    static public function getIdBySlug($slug) {
        $name = str_replace('-', ' ', $slug);
        return self::where('name', $name)->first()['id'];
    }

    public function getSlug() {
        return str_replace(' ', '-', $this->name);
    }
}
