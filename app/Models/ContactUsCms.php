<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsCms extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'visit_us',
        'call_us',
        'mail_us'
    ];
}
