<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shape extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =['name','logo','banner','description','userId'];

}
