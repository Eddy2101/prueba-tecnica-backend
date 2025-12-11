<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    //
    protected $fillable = [
        'code',
        'name',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
