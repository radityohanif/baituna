<?php

namespace App\Models;

use App\Enums\BillStatus;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $casts = [
        'amount' => 'int',
        'status' => BillStatus::class
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function activity_fee()
    {
        return $this->belongsTo(ActivityFee::class);
    }
}
