<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class User extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'uuid', 'activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'uuid'
    ];

    /**
     * The attributes dates
     *
     * @var array
     */
    protected $dates = [
        'activated', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes validations
     *
     * @var array
     */
    public $rules = [
        'name'                  => 'required',
        'email'                 => 'required|email|unique:user,email',
        'password'              => 'required|confirmed|min:6',
        'password_confirmation' => 'required',
        'phone'                 => 'string'
	];

    public function perfil() {
        return $this->belongsTo('App\Models\User\Perfil', 'id', 'user_id');
    }

    public function recoverPassword() {
        return $this->hasMany('App\Models\User\RecoverPassword', 'email', 'email');
    }

    public static function boot() {
        parent::boot();

        User::saving( function( $theUser ) {
            if( empty($theUser->uuid) ) {
                $theUser->uuid = Uuid::generate(4)->string;
            }
        });
	 }
}
