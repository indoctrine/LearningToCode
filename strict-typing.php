<?php declare(strict_types=1);

/*
    Simplifies type handling for $_POST variables in strict typing mode.

    CHANGES:
    24 July 2018
      - File created.
      - Added numerical validation to float and int.
    25 July 2018
      - Added function for forcing arrays to a particular type.
      - Learnt about passing by reference (&$) vs passing by value ($).
    26 July 2018
      - Updated code to remove second pass by reference on $value. This was
        referencing the value in the array itself, kind of circularly.
        &$arraytoforce -> $actualarray
        &$value -> $originalarrayvalue
    29 July 2018
      - Updated code to use return rather than pass by value. Kept the pass by
        ref code just in case.
*/

const INT = 0;
const STRING = 1;
const FLOAT = 2;

function GetPost($key, $type, $defaultval){
  $value = $_POST[$key] ?? $defaultval;

  switch($type){
    case INT:
      return is_numeric($value) ? intval(round($value)) : false;
    case STRING:
      return $value;
    case FLOAT:
      return is_numeric($value) ? floatval($value) : false;
    }
}

function ForceArrayType($arraytoforce, $type){
  foreach($arraytoforce as $index => $value){
    switch($type){
      case INT:
        $arraytoforce[$index] = is_numeric($value) ? intval($value) : false;
        break;
      case STRING:
        $arraytoforce[$index] = $value;
        break;
      case FLOAT:
        $arraytoforce[$index] = is_numeric($value) ? floatval($value) : false;
        break;
      default:
         $arraytoforce[$index] = false;
    }
  }
    return $arraytoforce;
}

/*function ForceArrayType(&$arraytoforce, $type){
  foreach($arraytoforce as $index => $value){
  //foreach($arraytoforce as $index => &$value){
    switch($type){
      case INT:
        $value = is_numeric($value) ? intval($value) : false;
      case STRING:
        return $value;
      case FLOAT:
        $value = is_numeric($value) ? floatval($value) : false;
    }
    $arraytoforce[$index] = $value;
  }
  unset($value);
}*/
?>
