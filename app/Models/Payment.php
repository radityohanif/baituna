<?php

namespace App\Models;

use App\Traits\HasDocumentNumber;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasDocumentNumber;

    const DOCUMENT_PREFIX = 'PAY';

    protected $casts = [
        'amount' => 'int'
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
