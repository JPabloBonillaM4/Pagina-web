<?php

    function userAuthenticated(){
        if(!userVerification())
        {
            header('Location:login.php');
            exit();
        }
    }

    function userVerification(){
        return isset($_SESSION['login']);
    }

    session_start();
    userAuthenticated();