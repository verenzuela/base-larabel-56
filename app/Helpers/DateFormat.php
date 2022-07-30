<?php

namespace App\Helpers;

class DateFormat {

  protected static $user_timezone = null;

  public function __construct(){

  }

  public static function getDateFormat(){
    return 'F j, Y';
  }

  
  public static function setUserTimezone($timezone){
    self::$user_timezone = $timezone;
  }


  public static function getLastDateOfTheMonth($mysql_date){
    return date('Y-m-t', strtotime($mysql_date));
  }


  public static function getLastDateOfTheWeek($mysql_date){
    $day = date('w', strtotime($mysql_date));
    if ($day == 0) $day = 7;
    $day -= 1;
    return date('Y-m-d', strtotime($mysql_date.' +'.(6-$day).' days'));
  }


  public static function getFirstDateOfTheWeek($mysql_date){
    $day = date('w', strtotime($mysql_date));
    if ($day == 0) $day = 7;
    $day -= 1;
    return date('Y-m-d', strtotime($mysql_date.' -'.$day.' days'));
  }


  public static function getMysqlDate($user_date, $input_date_format=null){
    if (empty($user_date)) {
      return NULL;
    }
    
    // If format is not specified then load predefined date format
    if (is_null($input_date_format)) {
      $input_date_format = self::getDateFormat();
    }
    
    // Create datetime object
    $date = new DateTime();
    
    // Create date from string in given format (!) there must be assignment (!)
    $date = $date->createFromFormat($input_date_format, $user_date);
    if ( ! $date) {
      return NULL;
    }
    
    // Return string in DB format
    return $date->format('Y-m-d');
  }


  public static function getUserDate($mysql_date, $output_date_format=null){
    $mysql_date = trim($mysql_date);
    if (empty($mysql_date) or $mysql_date == '0000-00-00' or $mysql_date == '0000-00-00 00:00:00') {
      return null;
    }

    // If format is not specified then load predefined date format
    if (is_null($output_date_format)) {
      $output_date_format = self::getDateFormat();
    }

    // If user's timezone is defined and mysql_date contains time information
    if (self::$user_timezone and strlen($mysql_date) == 19) {
      // Transform date into users timezone - we will return only date part probably but even day may be changed
      // by timezone change
      $mysql_date = Time::toUserTZ(self::$user_timezone, 'Y-m-d H:i:s', $mysql_date);
    }

    return date($output_date_format, strtotime($mysql_date));
  }


  public static function getMysqlDateTime($user_datetime, $user_datetime_format='@date H:i'){
    $user_datetime = trim($user_datetime);
    if (empty($user_datetime)) {
        return null;
    }

    // If predefined date format is needed
    if (strpos($user_datetime_format, '@date') !== false) {
      // Get date format
      $date_format = self::getDateFormat();
      // Update datetime format string
      $user_datetime_format = str_replace('@date', $date_format, $user_datetime_format);
    }

    // Create datetime object
    $date = new DateTime();
    
    // Create date from string in given format
    $date = $date->createFromFormat($user_datetime_format, $user_datetime);

    // Date object was not could not be initialized with user datetime value
    if ( ! $date) {
        return NULL;
    }
    
    // Get mysql date time string
    $mysql_datetime = $date->format('Y-m-d H:i:s');

    // If user's timezone is defined
    if (self::$user_timezone) {
      // Transform datetime into in user's timezone into db (default) timezone
      $mysql_datetime = Time::toSystemTZ(self::$user_timezone, 'Y-m-d H:i:s', $user_datetime);
    }

    // Return datetime string in given format
    return $mysql_datetime;
  }



  public static function getUserTime($mysql_time, $format=NULL){
    if (in_array($mysql_time, array('23:59:00', '00:00:00'))) {
      return 'Midnight';
    }
    if ($format === NULL) {
      $format = static::getDefaultTimeFormat();
    }
    return date($format, strtotime($mysql_time));
  }


  public static function getDefaultTimeFormat(){
    return 'g:ia';
  }

}