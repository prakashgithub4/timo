<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'first_name', 'last_name', 'dob', 'meritial_status', 'gender', 'user_id', 'created_at', 'updated_at'];
    protected $table = 'profiles';


}
