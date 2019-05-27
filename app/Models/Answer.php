<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package App\Models
 * @property string $link
 * @property int $product_id
 * @property-read Product $product
 * @method static self byProduct(Product $product)
 */
class Answer extends Model
{
    protected $fillable = ['link', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeByProduct(Builder $builder, Product $product)
    {
        return $builder->where('product_id', $product->id);
    }
}
