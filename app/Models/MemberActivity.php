<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberActivity extends Model
{
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, 'enrollment_year_id', 'id');
    }
}
