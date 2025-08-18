<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityFee extends Model
{
    protected $casts = [
        'amount' => 'int'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function fee_type()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function getNameAttribute()
    {
        return implode(' - ', array_filter([
            $this->activity?->name,
            $this->fee_type?->name,
            $this->academic_year?->name,
        ]));
    }
}
