<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    public function logins()
    {
        return $this->hasMany(Login::class);
    }


    public function lastLogin()
    {
        // return $this->hasOne(Login::class)->latest();
        return $this->belongsTo(Login::class);
    }

    public function scopeWithLastLogin($query)
    {
        $query->addSelect(['last_login_id', Login::select('id')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1)])->with('lastLogin');
    }



    public function scopeWithLastLoginAt($query)
    {
        $query->addSelect([
            'last_login' => Login::select('created_at')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->take(1)
        ])->withCasts(['last_login_at' => 'datetime']);
    }
    public function scopeWithLastLoginIpAdress($query)
    {
        $query->addSelect([
            'last_login_ip_address' => Login::select('ip_address')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->take(1)
        ]);
    }
}
