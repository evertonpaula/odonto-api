<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'width', 'height', 'file_id'
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
        'width'   => 'required|numeric',
        'height'  => 'required|numeric',
        'file_id' => 'required|numeric,exists:file,id,deleted_at,NULL'
	];

    public function file() {
        return $this->belongsTo('App\Models\File\File', 'file_id');
    }
}
