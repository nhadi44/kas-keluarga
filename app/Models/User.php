<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
         'email', 'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime'
    // ];

    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class);
    }

    public function saldo() {
        return $this->hasOne(Saldo::class);
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
