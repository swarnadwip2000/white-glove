<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliverAddress extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function address()
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            $address = DeliverAddress::where('user_id', auth()->user()->id)->first();
            return $address;
        } else {
            return null;
        }
    }
}
