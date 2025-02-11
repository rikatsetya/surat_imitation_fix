<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticateable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticateable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'name', 'email', 'password','created_at', 'updated_at'];

    protected $hiidden = ['password'];

    protected $casts = ['password' => 'hashed'];
    
    public function kepada(): HasMany
    {
        return $this->hasMany(SuratModel::class, 'kepada', 'user_id');
    }

    public function tembusan(): HasMany
    {
        return $this->hasMany(SuratModel::class, 'tembusan', 'user_id');
    }

    public function pengirim(): HasMany
    {
        return $this->hasMany(SuratModel::class, 'pengirim', 'user_id');
    }

    public function pemeriksa(): HasMany
    {
        return $this->hasMany(SuratModel::class, 'pemeriksa', 'user_id');
    }
        
    public function sender(): HasMany{
        return $this->hasMany(InboxModel::class, 'sender', 'user_id');
    }
    public function receiver(): HasMany{
        return $this->hasMany(InboxModel::class, 'receiver', 'user_id');
    }

}
