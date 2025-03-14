<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'sku',
        'unit_price',
        'stock',
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
