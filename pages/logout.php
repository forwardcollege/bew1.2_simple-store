<?php

    // if user session found, unset it
    if ( isset( $_SESSION['user'] ) ) 
        unset( $_SESSION['user'] );

    // redirect user to main page
    header("Location: /");
    exit;