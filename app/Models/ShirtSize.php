<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShirtSize extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'size',
        'shirt_id'
    ];
}
