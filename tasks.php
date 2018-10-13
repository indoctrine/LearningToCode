<?php declare(strict_types=1);
      require_once('strict-typing.php');
  /*
                            Task List
              Stores a list of tasks and allows completion.
                      An exercise in OO programming.

    CHANGES:
      13 October 2018 - File created. Current State: Form data stored in objects.
                      - Date and priority validation.

    TO DO:
      ***Basic Functionality***
      - Insert records incl. sanitising
      - Delete records
      - Mark completion of tasks
      - Output entire task list

      ***Intermediate Functions***
      - Update/edit records
      - Sort by date/priority
      - Search by date/priority

      ***Advanced Functions***
      - Multiple users
      - Extend due date
      - Span across multiple pages (eg. 5 records to a page) possibly using AJAX.
  */
  
  $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'tasks', 'abc123');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Sets error mode to throw PDOException so that it can be caught
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //Turns off prepared statement(?) emulate.
?>

<!doctype html>
<html>
  <head>
    <title>Tasks</title>
  </head>
  <body>
    <form method="post" id="form">
      <label>Priority</label>
      <select name = "priority">
        <option value = "5">5 - Least Urgent</option>
        <option value = "4">4</option>
        <option value = "3">3</option>
        <option value = "2">2</option>
        <option value = "1">1 - Most Urgent</option>
      </select>
      <br>
      <label>Due Date: </label><input type = "date" name = "duedate">
      <br>
      <textarea name = "description" rows = "10" cols = "50"></textarea>
      <br>
      <input type="submit" name="submit">
      <input type="reset" name="reset">
    </form>
    <pre>
    <?php
      class task{
        private $priority;
        private $duedate;
        private $description;

        function __construct(){
          $this->priority = GetPost('priority', INT, 5);

          if($this->priority < 1 || $this->priority > 5){ //Valid range for priority is 1-5.
            $this->priority = 5; //5 is least urgent therefore default value.
          }

          try{
            $now = new DateTime();
            $now->setTime(23, 59, 59); //Set current time to avoid time-related calc errors

            $defaultdate = clone $now;
            $defaultdate->modify('+1 week'); //Set a sane default

            if(isset($_POST['duedate'])){
              $this->duedate = new DateTime($_POST['duedate']);
            }
            else{
              $this->duedate = clone $defaultdate;
            }

            $this->duedate->setTime(23, 59, 59);
            $this->duedate->format('Y-m-d');

            if($this->duedate < $now){
              //Checks if due date is before today and set to sensible default if not.
              $this->duedate = clone $defaultdate;
            }
          }
          catch(Exception $e){
            echo $e->getMessage();
            exit(1);
          }

          $this->description = GetPost('description', STRING, null);
        }
      }

        if(isset($_POST['submit'])){
          $task = new task;
          print_r($task);
        }
    ?>
  </pre>
  </body>
</html>
