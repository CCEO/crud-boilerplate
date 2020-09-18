<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'continent_id'
    ];

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
     * Get the continent for the country.
     */
    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    /**
     * Get the states for the country.
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }

    /******************************************
     *                APPENDS                 *
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

    /**
     * Get the for the continent of this country
     */
    public function getContinentNameAttribute()
    {
        return $this->continent->name;
    }
}
