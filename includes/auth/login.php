<?php

    // call DB class
    $db = new DB();

    // get all POST data
    $email = $_POST["email"];
    $password = $_POST["password"];

    /* 
        do error checking
        - make sure all the fields are not empty
    */
    if ( empty( $email ) || empty( $password ) ) {
        $error = "Please fill out all the fields";
    }

    // find user by email
    $user =$db->fetch(
        'SELECT * FROm users where email = :email', 
        [
            'email' => $_POST['email']
        ]
    );

    // check if user exists
    if ( isset( $user ) && $user ) {
        // if user found, do password verification
        if ( password_verify( $password, $user['password'] ) ) {
            // once password is verified, set user's session
            $_SESSION["user"] = $user;

            // Redirect to home page
            header("Location: /");
            exit;
        
        } else {
            // if password is incorrect, define error message
            $error = "Your password is incorrect";
        }

    } else {
        // if user don't exists, define error message
        $error = "Email provided doesn't exists in our system";
    }

    // do error checking
    if ( isset( $error ) ) {
        // store the error message in session
        $_SESSION['error'] = $error;
        // redirect the user back to login.php
        header("Location: /login");
        exit;
    }