<?php

class Auth
{
    public static function user()
    {
        if (!User::logged_in()) {
            header('Location: /login.php');
            die();
        }
    }

    public static function guest()
    {
        if (User::logged_in()) {
            header('Location: /');
            die();
        }
    }

    public static function csrf_field()
    {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
        }
        
        return "<input type='hidden' name='csrf' value='$token'>";
    }

    public static function validate_csrf()
    {
        if (!isset($_POST['csrf']) || $_POST['csrf'] != $_SESSION['token']) {
            header('Location: /');
            die();
        }
    }
}
