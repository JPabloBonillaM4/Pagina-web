<?php
    header("Content-Type: text/html;charset=utf-8");
    $hash_options = array(
        'cost'=>12
    );

    if(isset($_POST['agregar-admin']))
    {
        $name     = $_POST['name'];
        $user     = $_POST['user'];
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT,$hash_options);
        $email    = $_POST['email'];
    }
    echo '<pre>';
        var_dump($password);
    echo '</pre>';