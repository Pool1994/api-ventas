<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear productos
        $products = Product::factory()->count(50)->create();

        // Crear ventas para enero y febrero de 2025
        $startDate = Carbon::create(2025, 1, 1);
        $endDate = Carbon::create(2025, 2, 28);

        while ($startDate->lte($endDate)) {
            for ($i = 0; $i < 10; $i++) {
                // Crear la venta
                $sale = Sale::factory()->create([
                    'sale_date' => $startDate->copy()->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
                    'total_amount' => 0, // Inicializar en 0
                ]);

                // Asociar productos a la venta
                $selectedProducts = $products->random(rand(1, 5));
                $totalAmount = 0;

                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 10);
                    $totalProductPrice = $product->price * $quantity;


                    // Crear registro en la tabla sale_details
                    SaleDetail::factory()->create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                    ]);

                    // Sumar al total_amount de la venta
                    $totalAmount += $totalProductPrice;
                }

                // Actualizar el total_amount de la venta
                $sale->update(['total_amount' => $totalAmount]);
            }

            $startDate->addDay();
        }
    }
}
