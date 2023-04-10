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

    public static function getReview($product_id)
    {
        $reviews = Review::where('product_id', $product_id)->get();
        $totalReview = $reviews->count();
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating += $review->rating;
        }

        if ($totalReview > 0) {
            $averageRating = ($totalRating) / ($totalReview);
        } else {
            $averageRating = 0;
        }
        return number_format((float)$averageRating, 2, '.', '');
    }
 }
