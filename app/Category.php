<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\transliterator_transliterate;
class Category extends Model
{
    protected $guarded = [];


    //one to many
    public function products(){
        return $this->hasMany(Product::class);
    }
}
