<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    // use SoftDeletes;

	public $table = "venues";

	protected $dates = ['deleted_at'];

	public $fillable = [
	    // "id",
		"venue",
		"address",
		// "created_at",
		// "updated_at",
		// "deleted_at"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"venue" => "string",
		"address" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
	public static $rules = [

	];

    public function shifts()
    {
        return $this->hasMany('App\Models\Shift');
    }
}
