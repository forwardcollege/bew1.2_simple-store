<?php

    // call the db class
    $db = new DB();

    // get the cart id
    $cart_id = $_POST['cart_id'];

    // delete from the cart table
    $db->delete(
        "DELETE FROM cart WHERE id = :id",
        [
            'id' => $cart_id
        ]
    );

    // redirect to cart page
    header("Location: /cart");
    exit;