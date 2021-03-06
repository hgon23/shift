<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'date_of_birth',
        'workplace',
        'firstname',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function name()
    {
        return $this->firstname . '&nbsp;' . $this->lastname;
    }

    public function shifts()
    {
        return $this->hasMany('App\Models\Shift');
    }
}
