<?php

namespace App\Models;

use App\Traits\HasDocumentNumber;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasDocumentNumber;

    const DOCUMENT_PREFIX = 'PAY';
}
