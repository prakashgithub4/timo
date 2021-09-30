<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;
    protected $table ='product_filters';
    protected $fillable =['filter_name','status', 'created_at', 'updated_at','min_range','max_range'];
    
}
