<?php

namespace App\Models;

use App\Enums\BillStatus;
use App\Traits\HasDocumentNumber;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasDocumentNumber;

    const DOCUMENT_PREFIX = 'BILL';

    protected $casts = [
        'amount' => 'int',
        'status' => BillStatus::class,
        'date' => 'datetime'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function activity_fee()
    {
        return $this->belongsTo(ActivityFee::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getRemainingAttribute()
    {
        $totalPaid = $this->payments()->sum('amount');
        return $this->amount - $totalPaid;
    }
}
