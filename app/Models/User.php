<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'username',
        'phone',
        'address',
        'shareholder_type',
        'role_id'


    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

// public function createToken(string $name, array $abilities = ['*'])
// {
//     $token = $this->tokens()->create([
//         'name' => $name,
//         'token' => hash('sha256', $plainTextToken = 'hh'),
//         'abilities' => $abilities,
//         // 'expired_at' => now()->addDays(3)
//     ]);
//     dd($token);
//     return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
// }
}