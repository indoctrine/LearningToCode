<?php
for($i=1; $i<=100; $i++){
    echo ($i % 3 == 0 ? "Fizz" : "");
    echo ($i % 5 == 0 ? "Buzz" : "");
    echo ($i % 5 !== 0 && $i % 3 !== 0 ? $i : "");
    echo "<br>";
}
?>
