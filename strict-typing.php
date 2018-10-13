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
    2 October 2018
      - Updated to use type declarations rather than math functions.
      - Corrected array forcing function to include rounding on integer values,
        omitted by mistake in the first place.
    11 October 2018
      - Made default value parameter optional with a default value of 0.
      - Added checks to check if the POST variables are set, if not,
        return the default value.
      - Added a check for non-compliant values in the case of numeric type casts.
        Non-compliant values will be set to 0.
*/

const INT = 0;
const STRING = 1;
const FLOAT = 2;

function GetPost($key, $type, $defaultval = 0){ //Specify $_POST array key, variable type and optional default value if fail.
  if(isset($_POST[$key])){
    $value = !empty($_POST[$key]) || $_POST[$key] != "" ? $_POST[$key] : $defaultval; //If POST variables are not set, return the default value.

    switch($type){
      case INT:
        $value = is_numeric($value) ? (int) round($value) : 0;
        return $value;
      case STRING:
        return (string) $value;
      case FLOAT:
        $value = is_numeric($value) ? (float) $value : 0;
        return $value;
      }
  }
}

function ForceArrayType($arraytoforce, $type){
  foreach($arraytoforce as $index => $value){
    switch($type){
      case INT:
        $arraytoforce[$index] = is_numeric($value) ? (int) round($value) : false;
        break;
      case STRING:
        $arraytoforce[$index] = (string) $value;
        break;
      case FLOAT:
        $arraytoforce[$index] = is_numeric($value) ? (float) $value : false;
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
