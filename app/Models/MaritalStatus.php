<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaritalStatus extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'marital_states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /******************************************
     *               RELATIONS                *
     ******************************************/

    /**
     * Get the human name of the created at date
     */
    public function getFormattedCreatedAtAttribute()
    {
        humanizeDate($this->created_at);
    }

    /**
     * Get the human name of the updated at date
     */
    public function getFormattedUpdatedAtAttribute()
    {
        humanizeDate($this->updated_at);
    }
}
