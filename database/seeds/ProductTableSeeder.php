<?php

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        ProductDetail::truncate();
        for($i=0; $i<30; $i++)
        {
            $name=$faker->sentence(2);
            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' =>$faker->sentence(20),
                'price' => $faker->randomFloat(3,1,20)
                
            ]);
            $productDetail = $product->getDetail()->create([
                'slider' =>rand(0,1),
                'opportunity_day' =>rand(0,1),
                'featured' =>rand(0,1),
                'bestseller' =>rand(0,1),
                'discount' =>rand(0,1),
            ]);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}