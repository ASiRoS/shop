<?php

use App\Models\Answer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var Product $product
         */
        foreach(Product::all() as $product) {
            $answer = new Answer();
            $answer->link = 'http://test.link';
            $answer->product_id = $product->id;
            $answer->save();
        }
    }
}
