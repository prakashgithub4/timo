<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price_Range extends Model
{
    use HasFactory;
    protected $table = 'price_range';
    public $timestamps = false;
}
