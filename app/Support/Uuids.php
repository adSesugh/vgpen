<?php

namespace App;

use Ramsey\Uuid\Uuid;

trait Uuids
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });
    }

    public function generateNewId()
    {
        return Uuid::uuid4();
    }
}
