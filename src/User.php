<?php

class User
{
    // public static function register()
    // {
    //     $hasDetails = isset($_POST['username'], $_POST['password'], $_POST['password_confirmation']);

    //     if ($hasDetails) {
    //         Auth::validate_csrf();
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    //         $password_confirmation = $_POST['password_confirmation'];

    //         $pw_hash = password_hash($password, PASSWORD_DEFAULT);

    //         $statement = DB::$handle->prepare('INSERT INTO user (name, password) VALUES (?, ?)');

    //         try {
    //             if ($statement->execute(array($username, $pw_hash))) {
    //                 User::login();
    //             }
    //         } catch (PDOException $e) {
    //             header('Location: /');
    //             die();
    //         }
    //     }
    // }

    public static function login()
    {
        $hasDetails = isset($_POST['username'], $_POST['password']);
        
        if ($hasDetails) {
            Auth::validate_csrf();
            $username = $_POST['username'];
            $password = $_POST['password'];

            $statement = DB::$handle->prepare('SELECT * FROM user WHERE name = ?');
            
            if ($statement->execute(array($username))) {
                $user = $statement->fetchObject();
                
                if ($user != false && password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                    die();
                }
            }
        }
    }

    public static function logout()
    {
        Auth::validate_csrf();
        session_unset();
        header('Location: /login.php');
        die();
    }

    public static function logged_in()
    {
        return isset($_SESSION['user']);
    }

    public static function current()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }
}
