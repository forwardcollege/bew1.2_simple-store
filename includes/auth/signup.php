<?php

    // call DB class
    $db = new DB();

    // get all POST data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    /* 
        retrieve the user based on the email provided
        to make sure there is no duplication of email in the users table
    */
    $user = $db->fetch( 
        "SELECT * FROM users where email = :email", 
        [
            'email' => $email
        ]
    );

    /* 
        do error checking 
        - make sure all the fields are not empty
        - make sure password is match
        - make sure password is at least 8 chars.
        -  make sure email provided is not already exists in the users table
    */
    // 1. make sure all fields are not empty
    if ( empty( $name ) || empty($email) || empty($password) || empty($confirm_password)  ) {
        $error = 'All fields are required';
    } else if ( $password !== $confirm_password ) {
        // 2. make sure password is match
        $error = 'The password is not match.';
    } else if ( strlen( $password ) < 8 ) {
        // 3. make sure password is at least 8 chars.
        $error = "Your password must be at least 8 characters";
    } else if ( $user ) {
        // 4. make sure email provided is not already exists in the users table
        $error = "The email you inserted has already been used by another user. Please insert another email.";
    }

    // if error found, set error into session and redirect user back to signup page
    if ( isset( $error ) ) {
        $_SESSION["error"] = $error;
        header("Location: /signup");
        exit;
    }

    // if no error found, process to account creation
    $db->insert(
        'INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)',
        [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]
    );

    // retrieve the newly signup user data
    $user = $db->fetch( 
        "SELECT * FROM users where email = :email", 
        [
            'email' => $email
        ]
    );

    // set the user data into session
    $_SESSION["user"] = $user;

    // set success message into session
    $_SESSION["success"] = "Account created successfully. You can now submit your answers";

    // redirect user to home page
    header("Location: /");
    exit;