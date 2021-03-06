<?php declare(strict_types=1);
/*
                  Discrete Mathematics for Computing
                                Chapter 1
                                Question 2

    Write an algorithm to input a period of time in hours,
    minutes and seconds, and output the time in seconds.
*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 2 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);\?>">
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
        foreach(array("hour", "minute", "second") as $unit){

          $value = $_POST[$unit] ?? 0; //Ternary isset (null coalesce)

          if(!is_numeric($value) || $value < 0 || is_null($value)){
            $value = 0;   //Validation
          }

          switch($unit){
            case "hour":
              $total = ($value * 3600);
              break;

            case "minute":
              $total += $value * 60;
              break;

            case "second":
              $total += $value;
              break;
          }

          $unit .= ($value != 1 ? "s" : "");

          echo "$value $unit ";
        }

        echo "<br> Totals: " . $total . " seconds.";
      }
  ?>
  </body>
</html>
