<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varification extends Model
{
    use HasFactory;
    protected $table = 'varification_codes';
    protected $fillable = ['code','valid'];
    protected $timestamp = false;
    public $timestamps = false;
}
