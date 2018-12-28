<?php declare(strict_types=1);
      require_once('../strict-typing.php');
      require_once('../helperfunctions.php');
/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 3

    Write an algorithm to input a number n, then calculate 1^2 + 2^2 + 3^2 ... + n^2,
    the sum of the first n perfect squares, and output the result.

    CHANGES:
      - 29 July 2018, included strict-typing.php, altered the output echo to be
        grammatically correct.
      - 5 August 2018 - Updated double quotes to singles.
      - 26 December 2018 - Moved a chunk of PHP off to an AJAX specific PHP file.
                         - Submit button now does AJAX call and does not refresh page.
                         - Default value was 1, which was a strange assumption to make,
                           now defaults to 0, which triggers the error handling.
*/

  if(isset($_POST['submit'])){
    $totalsquares = 0;
    $squares = GetPost('squares', INT, 0);

    if($squares <= 0){
      echo 'Please enter a positive, non-zero integer.';
      return;
    }

    for($i = 1; $i <= $squares; $i++){
      $totalsquares += $i * $i;
    }
    echo("$totalsquares is the total sum of the first " . ($squares == 1 ? '' : $squares) . ' perfect square' . pluraliser($squares) . '.');
  }
?>
