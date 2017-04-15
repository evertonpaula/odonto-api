<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'address_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
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
        'name' => 'required|string',
        'slug' => 'required|string'
	];

    public function addresses() {
        return $this->belongsToMany('App\Models\Address\Address', 'id', 'address_type_id');
    }

    public static function boot() {
        parent::boot();
        Type::saving( function( $theType ) {
            $theType->slug = str_slug($theType->name);
        });
	 }
}
