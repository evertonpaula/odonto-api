<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'country';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'iso_alpha2', 'iso_alpha3', 'iso_numeric', 'currency_code', 'currency_name', 'currrency_symbol'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes validations
     *
     * @var array
     */
    public $rules = [
        'name'              => 'required|string',
        'iso_alpha2'        => 'required|string',
        'iso_alpha3'        => 'required|string',
        'iso_numeric'       => 'required|string',
        'currency_code'     => 'required|string',
        'currency_name'     => 'required|string',
        'currrency_symbol'  => 'required|string'
	];

    public function addresses() {
        return $this->belongsToMany('App\Models\Address\Address', 'id', 'country_id');
    }
}
