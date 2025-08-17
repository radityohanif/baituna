<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityFee extends Model
{
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
}
