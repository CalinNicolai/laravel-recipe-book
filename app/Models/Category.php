<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','image'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}

