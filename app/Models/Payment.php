<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Traits\HasDocumentNumber;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasDocumentNumber;

    const DOCUMENT_PREFIX = 'PAY';

    protected $casts = [
        'amount' => 'int',
        'payment_date' => 'date',
        'method' => PaymentMethod::class
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
