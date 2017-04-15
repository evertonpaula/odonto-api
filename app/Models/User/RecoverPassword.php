<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class RecoverPassword extends Model
{
    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'recover_password';

    /**
     * The $timestamps fields
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'expire_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'token'
    ];

    /**
     * The attributes dates
     *
     * @var array
     */
    protected $dates = [
        'expire_at'
    ];

    /**
     * The attributes validations
     *
     * @var array
     */
    public $rules = [
        'email' => 'required|email|exists:user,email'
	];

    public function user() {
        return $this->hasOne('App\Models\User\User', 'email', 'email');
    }

    public static function boot() {
        parent::boot();
        RecoverPassword::saving( function( $recover ) {
            if( empty($recover->uuid) ) {
                $recover->token = Uuid::generate(4)->string;
                $dt = Carbon::now();
                $recover->expire_at = $dt->addWeek();
            }
        });
	}
}
