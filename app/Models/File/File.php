<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use SoftDeletes;

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'uuid', 'type', 'size', 'path'
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
        'uuid' => 'required|string',
        'type' => 'required|string',
        'size' => 'required|string',
        'path' => 'required|string'
	];

    public function image() {
        return $this->belongsTo('App\Models\File\Image', 'id', 'file_id');
    }
}
