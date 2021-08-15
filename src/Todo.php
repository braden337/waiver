<?php

class Todo
{
    public static function all()
    {
        $complete = DB::$handle->prepare('SELECT * FROM todo WHERE user_id = ? AND completed = true ORDER BY due');
        $incomplete = DB::$handle->prepare('SELECT * FROM todo WHERE user_id = ? AND completed = false ORDER BY due');
        
        if ($complete->execute(array(User::current()->id)) && $incomplete->execute(array(User::current()->id))) {
            return array('complete' => $complete->fetchAll(), 'incomplete' => $incomplete->fetchAll());
        } else {
            return array();
        }
    }
    
    public static function add()
    {
        $hasData = isset($_POST['description'], $_POST['date'], $_POST['time']);

        if ($hasData) {
            Auth::validate_csrf();
            $description = $_POST['description'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $due = "$date $time";

            $statement = DB::$handle->prepare('INSERT INTO todo (user_id, description, due) VALUES (?, ?, ?)');
            $statement->execute(array(User::current()->id, $description, $due));
        }
    }
}
