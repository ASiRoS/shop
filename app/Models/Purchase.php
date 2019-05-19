<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * @package App\Models
 * @property-read Product|null $product
 * @property string $customer
 * @property int $product_id
 */
class Purchase extends Model
{
    protected $fillable = ['customer', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}