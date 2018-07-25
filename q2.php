<?php declare(strict_types=1);

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
*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 2 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
      if(isset($_POST["submit"])){
        $total = 0;
        $unitmap = array(
          "hour" => 3600,
          "minute" => 60,
          "second" => 1);

        foreach($unitmap as $unit => $secsperunit){

          $value = $_POST[$unit] ?? 0; //Ternary isset (null coalesce)

          if(!is_numeric($value) || $value < 0 || is_null($value)){
            $value = 0;   //Validation
          }

          $total += $value * $secsperunit;

          $unit .= ($value != 1 ? "s" : "");

          echo "$value $unit ";
        }

        echo "<br> Totals: " . $total . " second" . ($total != 1 ? "s." : ".");
      }
    ?>
  </body>
</html>
