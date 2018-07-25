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
*/

const INT = 0;
const STRING = 1;
const FLOAT = 2;

function GetPost($key, $type, $defaultval){
  $value = $_POST[$key] ?? $defaultval;

  switch($type){
    case INT:
      return is_numeric($value) ? intval($value) : false;
    case STRING:
      return $value;
    case FLOAT:
      return is_numeric($value) ? floatval($value) : false;
    }
}

function ForceArrayType(&$arraytoforce, $type){
  foreach($arraytoforce as &$arrayelements){
    switch($type){
      case INT:
        $arrayelements = is_numeric($arrayelements) ? intval($arrayelements) : false;
      case STRING:
        return $arrayelements;
      case FLOAT:
        $arrayelements = is_numeric($arrayelements) ? floatval($arrayelements) : false;
    }
  }
  unset($arrayelements);
}
?>
