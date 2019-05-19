<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 * @property-read Product[]|null $products
 * @property string $name
 * @property int|null $price
 * @property bool $published
 * @method static Builder published
 */
class Category extends Model
{
    protected
        $fillable = ['name', 'published', 'price'],
        $casts = ['published' => 'boolean']
    ;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('published', 1);
    }
}
