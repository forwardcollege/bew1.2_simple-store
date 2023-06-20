<?php

    // call db class
    $db = new DB();

    // get total amount in cart
    $total_amount = $_POST['total_amount'];

    // create new order in orders table
    $db->insert(
        "INSERT INTO orders (`user_id`,`total_amount`) VALUES (:user_id, :total_amount)",
        [
            'user_id' => $_SESSION['user']['id'],
            'total_amount' => $total_amount
        ]
    );

    // get the last inserted order id
    $order_id = $db->lastInsertId();

    // get all the available products in cart
    $products_in_cart = $db->fetchAll(
        "SELECT * FROM cart
        WHERE user_id = :user_id AND order_id IS NULL",
        [
            'user_id' => $_SESSION['user']['id']
        ]
    );

    // loop through the products in cart, and insert the order_id into cart
    foreach( $products_in_cart as $cart ) {
        $db->update(
            "UPDATE cart SET order_id = :order_id WHERE id = :id",
            [
                'order_id' => $order_id,
                'id' => $cart['id']
            ]
        );
    }

    // redirect to orders page
    header("Location: /orders");
    exit;