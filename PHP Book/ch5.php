<?php declare(strict_types=1);
      require_once('../strict-typing.php');

/*
                    PHP and MySQL Web Development: A Beginners Guide
                                Chapter 5

    - Start by creating an HTML5 file and add the PHP section or "envelope". Save it as a PHP file.
    - Add print() and echo() functions.
    - Add a comment.
    - Add an escape sequence.
    - Define two variables and add echo() statements that increment one of the
      variables, and then compare the two variables, displaying the variables as literals.
    - Create an array that stores a name and email address, add the content,
      and then display the information.
    - Add a statement that displays today's date in any format and then
      displays the date one week from today.
    - Display a random number between 10 and 9.
    - Display the formatting of a string number.
    - Create your own function and call it at least twice.
                                ​
    CHANGES:
      - 5 August 2018, File created
*/

?>
<!doctype html>
<html>
  <head>
    <title>Chapter 5 - PHP & MySQL Web Development</title>
  </head>
  <body>
    <?php
      print('Printed \'Hello World!\' <br>');
      echo('Echoed \'Hello World!\' <br>');
      $a = 34;
      $b = 23;
      echo("Variables are: $a $b <br>");
      echo($a+1 . '<br>');
      echo('Is $a < $b? ' . ($a < $b ? 'true' : 'false') . '<br>');
      $c = array(
        'John Smith' => 'jsmith@example.com',
        'Jane Doe' => 'jdoe@example.com'
      );
      foreach($c as $value => $key){
        echo("$value - $key <br>");
      }
      $dateformat = 'l d F Y';
      $oneweek = (7 * 24 * 3600);
      echo(date($dateformat) . '<br>');
      echo('One week from now is: ' . date($dateformat, Time() + $oneweek) . '<br>');

      function rando($min, $max){
        return ($min + lcg_value() * (abs($max-$min)));
      }
      echo(rando(9, 10) . '<br>');
      echo(rando(28, 34));
    ?>
  </body>
</html>
