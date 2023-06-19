<?php

function isUserLoggedIn()
{
    // if the user is logged in, it will return true
    // if the user is not logged in, it will return false
    return isset( $_SESSION['user'] );
}