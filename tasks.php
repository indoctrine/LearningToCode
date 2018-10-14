<?php declare(strict_types=1);
      require_once('strict-typing.php');
  /*
                            Task List
              Stores a list of tasks and allows completion.
                      An exercise in OO programming.

    CHANGES:
      13 October 2018 - File created. Current State: Form data stored in objects.
                      - Date and priority validation.
      14 October 2018 - Added addtask() method. Interfaces correctly with database.
                      - Separated the getpost component out of the constructor as it
                        caused issues with intialising the object and being able todo
                        output the contents of the database without submitting the form.
                      - Added iscomplete() and markcomplete() methods.

    TO DO:
      ***Basic Functionality***
      - Insert records incl. sanitising ✓
      - Delete records
      - Mark completion of tasks
      - Output entire task list ✓

      ***Intermediate Functions***
      - Update/edit records
      - Sort by date/priority
      - Search by date/priority

      ***Advanced Functions***
      - Multiple users
      - Extend due date
      - Span across multiple pages (eg. 5 records to a page) possibly using AJAX.
  */
?>

<!doctype html>
<html>
  <head>
    <title>Tasks</title>
    <style>
      table {
        border-collapse: collapse;
      }

      table, th, td {
        border: 1px solid black;
        text-align: center;
        padding: 2px;
      }
    </style>
  </head>
  <body>
    <form method="post" id="form" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>">
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
      <input type="submit" name="addtask">
      <input type="reset" name="reset">
    </form>
    <pre>
    <?php
      class task{
        private $pdo;
        private $priority;
        private $duedate;
        private $description;

        function __construct(){
          $this->pdo = new PDO('mysql:host=localhost;dbname=tasks;charset=utf8', 'tasks', 'abc123');
          $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Sets error mode to throw PDOException so that it can be caught
          $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //Turns off prepared statement(?) emulate.
        }

        public function getformdata(){
          $this->priority = GetPost('priority', INT, 5);

          if($this->priority < 1 || $this->priority > 5){ //Valid range for priority is 1-5.
            $this->priority = 5; //5 is least urgent therefore default value.
          }

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

          $this->description = GetPost('description', STRING, null);
        }

        public function addtask(){
          $stmt = $this->pdo->prepare('INSERT INTO tasks (due_date, priority, description) VALUES (:duedate, :priority, :description)');
          $stmt->execute(['duedate' => $this->duedate->format('Y-m-d'), 'priority' => $this->priority, 'description' => $this->description]);
        }

        private function iscomplete($item){
          return $item == 0 ? "No" : "Yes";
        }

        public function markcomplete($task_id){
          $sql = $this->pdo->prepare('UPDATE tasks set completed = 1 where task_id = :taskid');
          $sql->execute(['taskid' => $task_id]);
        }

        public function displaytasks(){
          $sql = 'SELECT task_id, due_date, priority, completed, description from tasks';
          echo "<table class='tasks'>
            <tr>
              <th>Due Date</th>
              <th>Priority</th>
              <th>Completed</th>
              <th>Description</th>
            </tr>";
            ?>
          <form method='post' id='table' action='<?=htmlspecialchars($_SERVER['PHP_SELF']);?>'>
            <?php
          foreach($this->pdo->query($sql) as $row){
            $taskid = $row['task_id'];
            echo "<tr><td>" . $row['due_date'] . "</td>";
            echo "<td>" . $row['priority'] . "</td>";
            echo "<td>" . $this->iscomplete($row['completed']) . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td><input type='button' class='delete' name='del_$taskid' value='X'></td>";
            echo "<td><input type='button' class='complete' name='comp_$taskid' value='✓'></td>";
          }
          echo "</table></form>";
        }
      }
      $task = new task;

        if(isset($_POST['addtask'])){
          $task->getformdata();
          $task->addtask();
          //print_r($task);
        }
      $task->displaytasks();
    ?>
  </pre>
  </body>
</html>
