<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'city', 'zipcode', 'country_id', 'latitude', 'longitude', 'address_type_id'
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
        'address'         => 'required|string',
        'city'            => 'required|string',
        'zipcode'         => 'required|string',
        'country_id'      => 'required|exists:country,id',
        'latitude'        => 'string',
        'longitude'       => 'string',
        'address_type_id' => 'required|exists:address_type,id,deleted_at,NULL'
	];

    public function type() {
        return $this->belongsTo('App\Models\Address\Type', 'address_type_id');
    }

    public function country() {
        return $this->belongsTo('App\Models\Address\Country', 'country_id');
    }
}
