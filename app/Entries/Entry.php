<?php

namespace App\Entries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entry
 * @package App\Entries
 */
class Entry extends Model
{
    use SoftDeletes;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['id', 'first_name', 'last_name', 'phone'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];


}
