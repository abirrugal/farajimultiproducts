<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;



class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Factory();
        Product::factory()->count(20)->create();

        $products = Product::select('id')->get();

        foreach($products as $product){
        
            $product->addMediaFromUrl('https://source.unsplash.com/random/200x200?sig='.$product->id)->toMediaCollection();

        }
    }


}
