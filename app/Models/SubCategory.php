<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='subcategories';
    protected $fillable=['name', 'category_id', 'userId','slug','status','created_at', 'updated_at', 'deleted_at'];
    public function categories()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
