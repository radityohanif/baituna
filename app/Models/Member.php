<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'member_activities');
    }
}
