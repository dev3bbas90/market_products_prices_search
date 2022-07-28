<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer", "total"
    ];

    /**
     * Get all of the details for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }
}
