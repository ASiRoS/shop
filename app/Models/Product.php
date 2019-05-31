<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property int $id
 * @property bool $published
 * @property int $category_id
 * @property int $subject_id
 * @property string $prefix
 * @property int $price
 * @property Category|null $category
 * @property Subject|null $subject
 * @property string $description
 * @property string $image
 * @property string $name
 */
class Product extends Model
{
    protected
        $fillable = ['published', 'category_id', 'subject_id', 'prefix', 'price'],
        $casts = ['published' => 'boolean']
    ;

    public function getPriceAttribute(?int $price): int
    {
        return $price ?? $this->category->price;
    }

    public function getNameAttribute(): string
    {
        $prefix = $this->prefix ? "({$this->prefix})" : '';
        return $this->subject->name . ' ' . $prefix;
    }

    public function getImageAttribute(?string $image): string
    {
        return $image ?? 'img/products/default.png';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}