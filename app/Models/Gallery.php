<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $fillable = ['id', 'product_id', 'image', 'user_id', 'status'];
    public function product()
    {
        $this->belongsTo('App\Models\Product');
    }

    
   
}