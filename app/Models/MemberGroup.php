<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
