<?php
session_start();

require_once 'DB.php';

DB::init();

require_once 'User.php';
require_once 'Auth.php';
require_once 'Todo.php';

function dd($data) {
    $data = print_r($data, true);
    echo "<pre>$data</pre>";
    die();
}
