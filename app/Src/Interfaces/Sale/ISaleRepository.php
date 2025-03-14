<?php

namespace App\Src\Interfaces\Sale;

use App\Http\Requests\ProductRequestForm;
use App\Http\Requests\SaleRequestForm;

interface ISaleRepository
{
    public function all(array $params);
    public function register(SaleRequestForm $params);
}
