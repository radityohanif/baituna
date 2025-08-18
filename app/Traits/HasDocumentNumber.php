<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasDocumentNumber
{
    public static function bootHasDocumentNumber()
    {
        static::creating(function (Model $model) {
            if (empty($model->number)) {
                $model->number = $model::generateNumber();
            }
        });
    }

    public static function generateNumber(): string
    {
        $datePrefix = now()->format('ymd');
        $prefix = static::DOCUMENT_PREFIX ?? 'DOC';

        $lastDocument = static::where('number', 'like', "{$prefix}{$datePrefix}%")
            ->orderBy('number', 'desc')
            ->first();

        if ($lastDocument) {
            $lastCounter = (int)substr($lastDocument->number, -3);
            $newCounter = $lastCounter + 1;
        } else {
            $newCounter = 1;
        }

        return $prefix . $datePrefix . str_pad($newCounter, 3, '0', STR_PAD_LEFT);
    }
}
