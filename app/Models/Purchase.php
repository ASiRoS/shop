<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class Purchase
 * @package App\Models
 * @property-read Product|null $product
 * @property string $customer
 * @property int $product_id
 * @property int $bill_id
 * @property string $status
 * @method static self byBillId(integer $billId)
 */
class Purchase extends Model
{
    public const STATUSES = ['paid' => 'paid', 'waiting' => 'waiting'];

    protected $fillable = ['customer', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function generateBillId(): void
    {
        $this->bill_id = Uuid::uuid4()->toString();
    }

    public function setPaid()
    {
        $this->status = self::STATUSES['paid'];
    }

    public function setWaiting()
    {
        $this->status = self::STATUSES['waiting'];
    }

    public function scopeByBillId(Builder $builder, int $billId): self
    {
        return $builder->where('bill_id', $billId)->first();
    }
}