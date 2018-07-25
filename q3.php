<?php declare(strict_types=1);

/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 3

    Write an algorithm to input a number n, then calculate 1^2 + 2^2 + 3^2 ... + n^2,
    the sum of the first n perfect squares, and output the result.
*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 3 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div id="inputs">
        Number of Perfect Squares to Calculate: <input type="number" name="squares"><br>
      </div>
      <input type="submit" name="submit">
      <br>
    </form>
    <br>
    <?php
      if(isset($_POST["submit"])){
        $totalsquares = 0;
        $squares = round($_POST["squares"]);

        if($squares <= 0 || !is_numeric($squares)){
          echo "Please enter a positive integer";
          return;
        }

        for($i = 1; $i <= $squares; $i++){
          $totalsquares += $i * $i;
        }
        echo $totalsquares . " is the total sum of the first " . $squares . " perfect squares.";
      }
    ?>
  </body>
</html>
