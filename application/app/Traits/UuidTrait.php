<?php declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    protected static function boot() 
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }
    
    public function getKeyType(): string
    {
        return 'string';
    }
}