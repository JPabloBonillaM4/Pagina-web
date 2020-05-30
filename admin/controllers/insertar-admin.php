<?php
    include_once('../functions/functions.php');

    header("Content-Type: text/html;charset=utf-8");
    $hash_options = array(
        'cost'=>12
    );

    if(isset($_POST['agregar-admin']))
    {
        $name     = $_POST['name'];
        $user     = $_POST['user'];
        $email    = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT,$hash_options);
    }