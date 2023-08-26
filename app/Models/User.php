<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SDamian\Larasort\AutoSortable;
use SDamian\Larasort\Larasort;


    Larasort::setDefaultSortable('created_at');
    Larasort::setSortablesDefaultOrder([
        'desc' => ['created_at'],
    ]);


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;
    use AutoSortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'classroom_id',
        'role'
    ];

    private array $sortables = [
        'name',
        'email',
        'classroom_id',
        'role',
        'created_at',
    ];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function marks() {
        return $this->hasMany(Mark::class);
    }

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
}
