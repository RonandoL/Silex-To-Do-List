<?php
class Task
{
    private $description;

    function __construct($description)
    {
      $this->description = $description;
    }

    // Setter
    function setDescription($new_description)
    {
      $this->description = (string) $new_description;
    }

    // Getter
    function getDescription()
    {
      return $this->description;
    }

    // Save getAll()
    // function save()
    // {
    //   array_push($_SESSION['list_of_tasks'], $this);
    // }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}');");
    }  // Since we're declaring the $DB variable outside of the functions where we're using it (in the TaskTest.php file), we need to access it in a special way - using the $GLOBALS associative array. We want to save this particular task into the database, so we are inserting into the description column in the tasks table the value $this->getDescription().


    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $new_task = new Task($description);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }


}



?>
