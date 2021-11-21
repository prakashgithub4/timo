<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;
    protected $table ='cms';
    protected $fillable =['title', 'description','slug' ,'status', 'created_at', 'updated_at','cid'];
    


    public function categories()
    {
        return $this->belongsTo('App\Models\CmsCategory','cid','id');
    }
}
