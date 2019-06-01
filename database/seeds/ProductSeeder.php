<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $prefixes = [
        'ЕГЭ' => [
            'Математика' => [
                'База',
                'Профиль'
            ],
            'Английский язык' => 'Письменный',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $subjects = Subject::all();

        foreach($categories as $category) {
            foreach($subjects as $subject) {
                $categoryPrefixes = $this->prefixes[$category->name] ?? null;
                $subjectPrefixes = $categoryPrefixes[$subject->name] ?? [null];

                if(!is_iterable($subjectPrefixes)) {
                    continue;
                }

                foreach($subjectPrefixes as $prefix) {
                    $product = new Product();
                    $product->subject_id = $subject->id;
                    $product->category_id = $category->id;
                    $product->prefix = $prefix;
                    $product->description = sprintf('Ответы на "%s" %s', $product->name, $category->name);
                    $product->save();
                }
            }
        }
    }
}
