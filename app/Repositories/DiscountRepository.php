<?php

namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository
{

    public function _update($id, $data)
    {
        $shape = Discount::find($id);
        $shape->amount = $data['amount'];
        $shape->save();
    }
    public function _getdiscount()
    {
        return Discount::first();
    }
}
