<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait Userstamps
{
    public static function bootUserstamps()
    {
        static::creating(function (Model $model) {
            $model->created_by = Auth::id();
        });

        static::updating(function (Model $model) {
            $model->updated_by = Auth::id();
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
