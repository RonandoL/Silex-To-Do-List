<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    // To access the users' cookies, we use a built-in PHP variable called $_SESSION.
    session_start();
    if (empty($_SESSION['list_of_tasks'])) {
        $_SESSION['list_of_tasks'] = array();
    }  // $_SESSION is a superglobal variable like $_GET, which means we can access it from anywhere in our code. We’re going to store an array of all our Tasks inside of $_SESSION as a value at the key 'list_of_tasks'.

    $app = new Silex\Application();

    $app->get("/", function() {

        // calling the getAll() static method on the class itself.
        foreach (Task::getAll() as $task) {
            $output = $output . "<p>" . $task->getDescription() . "</p>";
        }

        // Add a FORM to create new tasks when we press the submit button. This is where HTTP POST requests come in. Loop through tasks stored in the array. Then displays form when new task is submitted. We are creating a task.
        $output = $output . "
            <form action='/tasks' method='post'>
                <label for='description'>Task Description</label>
                <input id='description' name='description' type='text'>

                <button type='submit'>Add task</button>
            </form>
        ";

        return $output;
    });

    $app->post("/tasks", function() {
        $task = new Task($_POST['description']);
        $task->save();  // we save after instantiating.
        return "
            <h1>You created a task!</h1>
            <p>" . $task->getDescription() . "</p>
            <p><a href='/'>View your list of things to do.</a></p>
        ";
    }); // We a instantiate a new task when the submit button is pressed by getting the user's description out of the superglobal $_POST.

    return $app;



?>
