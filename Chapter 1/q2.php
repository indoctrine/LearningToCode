<?php declare(strict_types=1);
      require_once('../strict-typing.php');
      require_once('../helperfunctions.php');
/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 2

    Write an algorithm to input a period of time in hours,
    minutes and seconds, and output the time in seconds.

    Notes:
      - Learnt about null coalesce operator which is a ternary shortcut for isset
      - Learnt about array key pairs
      - Learnt about the concatenation operator

    CHANGES:
      - 29 July 2018, updated code to use strict-typing function and removed
        superfluous parts of validation.
      - 5 August 2018 - Updated double quotes to singles. Included helper functions
        file and implemented pluraliser.
      - 11 October 2018 - Added condition to additional validation. Removed superfluous
        $defaultval for GetPost() now that function has been made more useful.
*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 2 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <div id="inputs">
        Hours: <input type="number" name="hour"><br>
        Minutes: <input type="number" name="minute"><br>
        Seconds: <input type="number" name="second"><br>
      </div>
      <p id="errormsg" style="color: #FF0000"></p>
      <input type="submit" name="submit">
      <br>
    </form>
    <br>
    <?php
      if(isset($_POST['submit'])){
        $total = 0;
        $unitmap = array(
          'hour' => 3600,
          'minute' => 60,
          'second' => 1);

        foreach($unitmap as $unit => $secsperunit){

          $value = GetPost($unit, INT, 's');

          if($value < 0 || is_null($value)){
            $value = 0;   //Validation
          }

          $total += $value * $secsperunit;

          $unit .= pluraliser($value);

          echo "$value $unit ";
        }

        echo "<br> Totals: $total second" . pluraliser($total) . '.';
      }
    ?>
  </body>
</html>
