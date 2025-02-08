<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'iva',
        'discount'
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

}
