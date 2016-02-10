<?php
class Task
{
  private $description;

  function __construct($description)
  {
      $this->description = $description;
  }

  // Setter Getter
  function setDescription($new_description)
  {
      $this->description = (string) $new_description;
  }

  function getDescription()
  {
      return $this->description;
  }

  // We want to store a Task by calling a save method on it. We're going to do that by storing the objects in cookies on the users' browser. To access the users' cookies, we use a built-in PHP variable called $_SESSION.
  function save()
  {
      array_push($_SESSION['list_of_tasks'], $this);
  }

  // loop through all of our saved tasks in $_SESSION['list_of_tasks']. It's a static method. It's a getter, but it works on the whole class: its job will be to return the list of all our tasks.
  static function getAll()
  {
      return $_SESSION['list_of_tasks'];
  }
  // Static methods get called on the class itself (here, on Task), rather than on one instance. They're useful when you want to do something that involves more than one instance, or to create some functionality that has to do with the class rather than any individual instance.


}



?>
