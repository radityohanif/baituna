<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function activities()
    {
        return $this->hasMany(MemberActivity::class, 'member_id', 'id');
    }
}
