<?php

namespace App\Helpers;

use Config;
use DB;

class Constants
{
    /**
    *
    *
    *
    */
    static function get($type) {
		return (Config::get('constants.'.$type)) ? Config::get('constants.'.$type) : false;
    }


    /**
    *
    *
    *
    */
    static function getTzList() {
        $zones_array = array();
        $timestamp = time();
        $zones_array['-'] = 'Choose Timezone';
        foreach(timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            //$zones_array[$key]['zone'] = $zone;
            //$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
            $zones_array[$zone] = 'UTC/GMT ' . date('P', $timestamp) . ' - ' .$zone;
        }
        return $zones_array;
    }



    /**
    *
    *
    *
    */
    static function getMonthYears() {
      for ($m=1; $m<=12; $m++) { $month[date('m', mktime(0,0,0,$m, 1, date('Y')))] = date('m', mktime(0,0,0,$m, 1, date('Y'))); };
      for ($y=0; $y<=10; $y++) { $year[date('Y')+$y] = date('Y')+$y; };
      $months_years = [
        'months' => $month,
        'years' => $year,
      ];

      return $months_years;
    }

}