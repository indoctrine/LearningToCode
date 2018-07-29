<?php declare(strict_types=1);
      require_once('../strict-typing.php');

/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 1

    Modify the algorithm in Example 1.2.1 so that the output also
    includes the position in the list where the smallest number occurs.

    Example 1.2.1
    Find the smallest number in a list of numbers. The smallest number can be
    found by looking at each number in turn, keeping track at each step of the
    smallest number so far.
          1. Input the number of values n
          2. Input the list of numbers x1, x2, ..., x(n)
          3. min <- x1
          4. For i = 2 to n do
              4.1. If x(i) < min then
                  4.1.1. min <- x(i)
          5. Output min

    CHANGES:
      - 29 July 2018, changed numberlist array to work with return value from
        strict-typing.php
*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 1 - Local</title>
  </head>
  <body>
    <style>
      p{
        display: inline-block;
        white-space: pre;
      }
    </style>
    <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div id="inputs">
        <p>Number 1:</p> <input type="number" name="numberlist[]" step="any"><br>
      </div>
      <p id="errormsg" style="color: #FF0000"></p>
      <input id="addmore" type="button" value="Add more inputs" onClick="addinput('inputs')">
      <br>
      <br>
      <input type="submit" name="submit">
    </form>
    <script src="q1.js"></script>

    <?php

      if(isset($_POST['submit'])){
        //$numberlist = $_POST['numberlist'];
        //ForceArrayType($numberlist, FLOAT);
        $numberlist = ForceArrayType($_POST['numberlist'], FLOAT);
        $i = 0;
        $x = 0;
        echo "<br><br>You entered: <br>";
        foreach($numberlist as $eachinput){

          $x++;

          if($x > 10){
            break;
          }

          if(!is_numeric($eachinput)){
            $i++;   //Counts any non-numeric values for avg calc correction
            continue;
          }

          if(!isset($min) || $eachinput < $min){
            $min = $eachinput;
            $minloc = $x;
          }

          echo $eachinput . "<br>";

          if(!isset($max) || $eachinput > $max){
            $max = $eachinput;
            $maxloc = $x;
          }

        }

        $count = count($numberlist) - $i;
        echo "<br> The smallest number is " . $min . " which was located in box number " . $minloc;
        echo "<br> The largest number is " . $max . " which was located in box number " . $maxloc;
        $avg = array_sum($numberlist) / $count;
        echo "<br> The average is " . $avg;
    }
      ?>
  </body>
</html>
