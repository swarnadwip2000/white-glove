<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   
    public function getDiscountedPriceAttribute()
    {
        $discounted_price = ($this->price * $this->discount)/100;
        $discounted_offer = $this->price - $discounted_price;
        return round($discounted_offer);
    }

    public static function totalProductRating($id)
    {
        $total_user_rating = Review::where('product_id', $id)->count();
        if($total_user_rating > 0)
        {
            $sum_rating = Review::where('product_id', $id)->sum('rating');
            $total_rating = ($sum_rating / $total_user_rating);
            return $total_rating;
        }
      
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
 }
