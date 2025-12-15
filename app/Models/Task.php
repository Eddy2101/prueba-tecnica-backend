<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    use HasUuids;

    protected $primaryKey = 'c_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'c_id_priority',
        'c_id_status',
        'c_activo',
        'c_usu_alta',
        'c_usu_actualiza',
        'f_alta',
        'f_actualiza',
    ];

    protected $casts = [
        'c_activo' => 'string',
        'f_alta' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class,'c_id_status');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class,'c_id_priority');
    }
}
