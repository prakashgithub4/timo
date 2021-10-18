<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeMapping extends Model
{
    use HasFactory;
    protected $table ='product_attribute_mapping';

    protected $fillable =['pid','aid'];
    public function Product()
    {
        return $this->belongsTo('App\Models\Product','pid','id');
    }

    public function Attribute()
    {
        return $this->belongsTo('App\Models\Attribute','aid','id');
    }
   
    
}
