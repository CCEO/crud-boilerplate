<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id'
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
     * Get the country for the state.
     */
    public function country()
    {
        return $this->belongsTo(Country::class)->withTrashed();
    }

    /******************************************
     *                APPENDS                 *
     ******************************************/

    /**
     * Get the human name of the created at date
     */
    public function getFormattedCreatedAtAttribute()
    {
        $dt = Carbon::parse($this->created_at);
        return ucfirst($dt->locale('es')->dayName) . " " . $dt->day . " del " . ucfirst($dt->locale('es')->monthName) . " de " . $dt->year . " a las " . $dt->hour . ":" . $dt->minute . ":" . $dt->second;
    }

    /**
     * Get the human name of the updated at date
     */
    public function getFormattedUpdatedAtAttribute()
    {
        $dt = Carbon::parse($this->updated_at);
        return ucfirst($dt->locale('es')->dayName) . " " . $dt->day . " del " . ucfirst($dt->locale('es')->monthName) . " de " . $dt->year . " a las " . $dt->hour . ":" . $dt->minute . ":" . $dt->second;
    }

    /**
     * Get the country name for this record
     */
    public function getCountryNameAttribute()
    {
        return $this->country->name;
    }
}
