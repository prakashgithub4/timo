<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =['name','short','userId', 'status', 'image','slug'];
    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory','category_id','id');
    }
   
    
}
