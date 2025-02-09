<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'count', 'invoice_id', 'gross_value', 'net_value', 'iva', 'discount'
    ];
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
