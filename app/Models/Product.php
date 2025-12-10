<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image'
    ];
public function movements()
{
    return $this->hasMany(InventoryMovement::class);
}

public function applyMovement($type, $quantity)
{
    if ($type === 'entrada') {
        $this->stock_quantity += $quantity;
    } else {
        $this->stock_quantity -= $quantity;
    }

    $this->save();
}

}

