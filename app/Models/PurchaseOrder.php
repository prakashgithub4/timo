<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='order_placed';

    protected $fillable = [
        'first_name',
        'last_name', 
        'state',
        'country',
        'address',
        'email',
        'phone',
        'shipping_address',
        'order_notes',
        'order_total',
        'coupan_code',
        'payment_status',
        'payment_mode',
        'comapny',
        'optional_address',
        'uid'
    ];

}
