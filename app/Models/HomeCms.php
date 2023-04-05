<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCms extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_title',
        'banner_description',
        'section_2_image',
        'section_2_title',
        'section_3_image',
        'section_3_title',
        'section_3_description',
    ];
}
