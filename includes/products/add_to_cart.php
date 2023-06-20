<?php

    // call db class
    $db = new DB();

    // get the product id
    $product_id = $_POST['product_id'];

    // add the product into cart table
    $db->insert(
        "INSERT INTO cart (`product_id`,`quantity`,`user_id`) VALUES (:product_id, :quantity, :user_id)",
        [
            'product_id' => $product_id,
            'quantity' => 1,
            'user_id' => $_SESSION['user']['id']
        ]
    );

    // redirect to cart page
    header("Location: /cart");
    exit;
