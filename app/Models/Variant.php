<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sap_product_code',
        'web_product_code',
        'name',
        'product_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
