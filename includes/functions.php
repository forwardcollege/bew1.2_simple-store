<?php

function connectToDB()
{
    return new PDO(
        'mysql:host=mysql;dbname=php_docker',
        'root',
        'secret'
    );
}

function isLoggedIn()
{
    // if the user is logged in, it will return true
    // if the user is not logged in, it will return false
    return isset( $_SESSION['user'] );
}

function logout()
{
    // delete the session data so that the user logout
    unset( $_SESSION['user'] );
}