<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'sku',
        'price',
        'stock',
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
