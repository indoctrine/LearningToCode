<?php
  /*for($i=1; $i<=100; $i++){
    if($i % 3 == 0){
      echo "Fizz";
    }
    if($i % 5 == 0){
      echo "Buzz";
    }
    if($i % 5 != 0 && $i % 3 !=0){
      echo $i;
    }
    echo "<br>";
  }*/
?>

<?php
  for($i=1; $i<=100; $i++){
    if($i % 5 == 0 && $i % 3 ==0){
      echo "FizzBuzz";
    }
    else if($i % 3 == 0){
      echo "Fizz";
    }
    else if($i % 5 == 0){
      echo "Buzz";
    }
    else{
      echo $i;
    }
    echo "<br>";
  }
?>
