<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function doctor(){
      return $this->hasOne('App\Models\Doctor');
    }

    public function patient(){
      return $this->hasOne('App\Models\Patient');
    }

    public function roles(){
      return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function authoriseRoles($roles) {
      if (is_array($roles)) {
        return $this->hasAnyRole($roles) ||
                  abort(401, 'This action is unauthorised.');
      }
      return $this->hasRole($roles) ||
                abort(401, 'This action is unauthorised.');
    }

    public function hasAnyRole($roles) {
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role) {
      return null !== $this->roles()->where('name', $role)->first();
    }
}
