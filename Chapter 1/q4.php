<?php declare(strict_types=1);
      require_once('strict-typing.php');
/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 4

    Write an algorithm to input the price of a purchase and the amount tendered,
    and calculate the change due. An appropriate message should be output if the
    amount tendered is less than the purchase price.

    Notes:
      - Learnt about sprintf and outputting certain number of decimal places
      - Padding in spritnf continues to be a dark art but the gist is the first
        digit after the % sign is number of spaces for padding, second is number
        of 0s to pad with.

        %8.2f 10345.00    8 = total number of digits, pads rest with spaces
               1034.00    .2 = two decimal places
                134.00
                 13.00
        %08.2f 10345.00   0 = Pads with zeroes, 8 = total number of digits
               01034.00
               00134.00
               00000.34

        0.346 rounds up, 0.345 rounds down, 0.344 rounds down with sprintf decimal
        Best to use the round function to get the desired form of rounding (that
        is, rounding up on 0.345).
      - 23 July 2018 - Learnt about number_format() which comma separates the numbers
        by default with the second parameter specifying number of decimal places.
        Can't be used on a string, which is what $_POST pushes. Added floatval()
        to force variables to be float values when assigned.
      - 24 July 2018 - Replaced a portion of the code with a function. Added the
        strict typing helper script for $_POST.
      - 25 July 2018 - Made variable assignment in line with validate().

*/

?>
<!doctype html>
<html>
  <head>
    <title>Question 4 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div id="inputs">
        Purchase Price: $<input type="number" name="pprice" step="any"><br>
        Amount Tendered: $<input type="number" name="tendered" step="any"><br>
      </div>
      <input type="submit" name="submit">
      <br>
    </form>
    <br>
    <?php
      if(isset($_POST["submit"])){
        function validate($input){
          if($input <= 0){
            exit("Please enter a positive number.");
          }
        }

        $change = 0;

        validate($pprice = GetPost("pprice", FLOAT, 0));
        validate($tendered = GetPost("tendered", FLOAT, 0));

        if($tendered < $pprice){
          exit("You do not have enough money to complete this transaction");
        }

        $change = $tendered - $pprice;

        echo "Purchase Price: $" . number_format($pprice, 2);
        echo "<br> Amount Tendered: $" . number_format($tendered, 2);
        echo "<br> Change Due: $" . number_format($change, 2);
      }
    ?>
  </body>
</html>
