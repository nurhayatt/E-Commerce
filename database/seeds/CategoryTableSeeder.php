<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
   $id= DB::table('categories')->insertGetId([
        'name'=>'Elektronik', 'slug'=>'elektronik'
         ]);
    DB::table('categories')->insert([
            'name' => 'Bilgisayar/Tablet', 'slug' => 'bilgisayar-tablet','top_id'=>$id
        ]);
        DB::table('categories')->insert([
            'name' => 'Telefon', 'slug' => 'telefon', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'TV ve Ses Sistemleri', 'slug' => 'tv-ses-sistemleri', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'Kamera', 'slug' => 'kamera', 'top_id' => $id
        ]);
    
      $id = DB::table('categories')->insert([
            'name' => 'Kitap', 'slug' => 'kitap'
        ]);
        DB::table('categories')->insert([
            'name' => 'Edebiyat', 'slug' => 'edebiyat', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'Çocuk', 'slug' => 'cocuk', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'Bilgisayar', 'slug' => 'bilgisayar', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'Sınavlara Hazırlık', 'slug' => 'sinavlara-hazirlik', 'top_id' => $id
        ]);
        DB::table('categories')->insert([
            'name' => 'Dergi', 'slug' => 'dergi'
        ]);
        DB::table('categories')->insert([
            'name' => 'Mobilya', 'slug' => 'mobilya'
        ]);
        DB::table('categories')->insert([
            'name' => 'Dekorasyon', 'slug' => 'dekorasyon'
        ]);
        DB::table('categories')->insert([
            'name' => 'Kozmetik', 'slug' => 'kozmetik'
        ]);
        DB::table('categories')->insert([
            'name' => 'Kişisel Bakım', 'slug' => 'kisisel-bakim'
        ]);
        DB::table('categories')->insert([
            'name' => 'Giyim ve Moda', 'slug' => 'giyim-moda'
        ]);
        DB::table('categories')->insert([
            'name' => 'Anne ve Çocuk', 'slug' => 'anne-cocuk'
        ]);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
        
    }
}