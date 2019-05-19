<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        'ОГЭ' => 190,
        'ЕГЭ' => 290,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->categories as $name => $price) {
            $category = new Category();
            $category->name = $name;
            $category->price = $price;
            $category->save();
        }
    }
}
