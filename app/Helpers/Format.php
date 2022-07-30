<?php

namespace App\Helpers;

class Format {


  static public function phone($number){
    $orig_number = $number;
    
    $number = str_replace(' ', '', $number);

    $number = trim($number, '+');

    if (strlen($number) == 9){
      return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $number);
    }else if (strlen($number) == 12){
      return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{3})/", "+$1 $2 $3 $4", $number);
    }
    return $orig_number;
  }


  static public function phone_us($number){
    $number = preg_replace('/[^0-9]/', '', $number);
    $number = preg_replace('/^(.*?)(.{1,3})(.{3})(.{4})$/', '$1 ($2) $3-$4', $number);
    return $number;
  }

  static public function phoneNumbers($numbers) {
    foreach ($numbers as $i => $number){
      $numbers[$i] = format::phone($number);
    }

    return implode(", ", $numbers);
  }


  static public function price($price, $currency='USD', $separator='&nbsp;'){

    //$price = str_replace('.', '', $price);
    if(!$currency)
      return number_format($price, 2, ',', '.');
    else
      return number_format($price, 2, ',', '.') . $separator. $currency;
  }


  static public function truncateExtraDecimals($val, $precision) {
    $pow = pow(10, $precision);
    $precise = (int)($val * $pow);
    return (float)($precise / $pow); 
  }


  public static function mysqlDateRange($start_date, $end_date){
    $cur_time = strtotime($start_date.' 06:00:00');
    $end_time = strtotime($end_date.' 10:00:00');
    $res = array();
    while ($cur_time <= $end_time) {
        $date = date('Y-m-d', $cur_time);
        $res[] = "SELECT '$date' AS date";
        $cur_time += 86600;
    }

    if (empty($res)) {
        return '(SELECT NULL)';
    }
    return '(' . implode(' UNION ', $res) . ')';
  }


  public static function minifyHtml($Html) {
   $Search = array(
    '/(\n|^)(\x20+|\t)/',
    '/(\n|^)\/\/(.*?)(\n|$)/',
    '/\n/',
    '/\<\!--.*?-->/',
    '/(\x20+|\t)/', # Delete multispace (Without \n)
    '/\>\s+\</', # strip whitespaces between tags
    '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
    '/=\s+(\"|\')/'); # strip whitespaces between = "'

   $Replace = array(
    "\n",
    "\n",
    " ",
    "",
    " ",
    "><",
    "$1>",
    "=$1");

    $Html = preg_replace($Search,$Replace,$Html);
    return $Html;
  }


}