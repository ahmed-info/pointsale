<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path','profit_percent'];
                    
    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    }

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent =  $profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }

    public function getProfitAttribute(){
        $profit = $this->sale_price - $this->purchase_price;
        return $profit;
    }

    //protected $fillable = [
    //    'name','description', 'image', 'purchase_price','sale_price','stock'
    //];
    // many to one
    public function category(){                               
        return $this->belongsTo(Category::class); //App\Category
    }
}
