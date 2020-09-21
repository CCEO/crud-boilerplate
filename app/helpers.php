<?php
use Carbon\Carbon;

/**
 * Get formatted date in long mode for any date
 *
 * @return: String
 */
function humanizeDate($date)
{
    $dt = Carbon::parse($date);
    return ucfirst($dt->locale('es')->dayName) . " " . $dt->day . " de " . ucfirst($dt->locale('es')->monthName) . " del " . $dt->year . " a las " . $dt->format('H:i:s');
}
