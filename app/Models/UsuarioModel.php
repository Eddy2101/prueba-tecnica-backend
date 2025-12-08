<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioModel extends Authenticatable implements JWTSubject
{
    protected $table = 'usuarios';
    protected $primaryKey = 'c_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        's_nombre',
        's_email',
        's_contrasenia',
        'c_usu_alta',
        'c_usu_actualiza',
        'c_activo',
    ];

    protected $hidden = [
        's_contrasenia',
    ];

    protected $casts = [
        'c_activo' => 'string',
        'f_alta' => 'datetime',
        'f_actualiza' => 'datetime',
    ];

    // Generar UUID automáticamente al crear
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->c_id)) {
                $model->c_id = (string) Str::uuid();
            }
            $model->f_alta = now();
            $model->f_actualiza = now();
        });

        static::updating(function ($model) {
            $model->f_actualiza = now();
        });
    }

    // Métodos para JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            's_nombre' => $this->s_nombre,
            's_email' => $this->s_email
        ];
    }

    public function getAuthPassword()
    {
        return $this->s_contrasenia;
    }


    // Override para usar s_contrasenia en lugar de password
    public function getAuthIdentifierName()
    {
        return 's_email';
    }
}