<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'user_perfil';

    /**
     * The table primary key
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image_id', 'first_name', 'last_name', 'phone', 'address_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes dates
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes validations
     *
     * @var array
     */
    public $rules = [
        'user_id'    => 'required|exists:user,id,deleted_at,NULL',
        'image_id'   => 'numeric',
        'first_name' => 'required|string',
        'last_name'  => 'string',
        'phone'      => 'string',
        'address_id' => 'numeric'
	];

    public function user() {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    public function image() {
        return $this->belongsTo('App\Models\File\Image', 'image_id');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address\Address', 'address_id');
    }

    public static function boot() {
        parent::boot();
	}
}
