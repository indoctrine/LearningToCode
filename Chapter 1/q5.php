<?php declare(strict_types=1);
      require_once('../strict-typing.php');
/*
                    Discrete Mathematics for Computing
                                Chapter 1
                                Question 5

    Write an algorithm to calculate the tax payable on a give taxable income, according to the following rules:

    Taxable Income    |      Tax
    -----------------------------------------------------------------------
    $1-$5400          |      0
    $5401–$20700      |      0 plus 20 cents for each $1 over $5400
    $20701-$38000     |      $3060 plus 34 cents for each $1 over $20700
    $38001-$50000     |      $8942 plus 43 cents for each $1 over $38000
    $50001 and over   |      $14102 plus 47 cents for each $1 over $50000
    -----------------------------------------------------------------------

    Notes:
    - 11 October 2018 - File created
​*/
?>

<!doctype html>
<html>
  <head>
    <title>Question 4 - Local</title>
  </head>
  <body>
    <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <div id="inputs">
        Taxable Income: $<input type="number" name="taxable" step="any"><br>
      </div>
      <input type="submit" name="submit">
      <br>
    </form>
    <br>
  <?php
    class taxcalc{
      public $taxbrackets[5400, 20700, 38000, 50000];
    }

    if(isset($_POST["submit"])){
        $taxable = GetPost('taxable', INT);
        if($taxable < 0){
          exit('Please enter a positive number.');
        }
      }

  ?>
