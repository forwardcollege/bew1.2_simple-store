<?php

    $db = new DB();

    $products_in_cart = [];
    $total_in_cart = 0;

    require 'parts/header.php';
?>

        <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
            
            <div class="min-vh-100">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h1">My Cart</h1>
                </div>
    
                <!-- List of products user added to cart -->
                <table class="table table-hover table-bordered table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- if no products in the cart -->
                    <?php if ( empty( $products_in_cart ) ) : ?>
                        <tr>
                            <td colspan="5">Your cart is empty.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach( $products_in_cart as $product ) : ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td>$<?php echo $product['price']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td>$<?php echo $product['total']; ?></td>
                                <td>
                                    <form
                                        method="POST"
                                        action="/products/remove_from_cart"
                                        >
                                        <input 
                                            type="hidden"
                                            name="product_id"
                                            value="<?php echo $product['id']; ?>"
                                            />
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end">Total</td>
                            <td>$<?php echo $total_in_cart; ?></td>
                            <td></td>
                        </tr>
                    <?php endif; // end - empty( $products_in_cart ) ?>
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-between align-items-center my-3">
                    <a href="/" class="btn btn-light btn-sm">Continue Shopping</a>
                    <!-- if there is product in cart, then only display the checkout button -->
                    <?php if ( !empty( $products_in_cart ) ) : ?>
                        <form
                            method="POST"
                            action="/products/checkout"
                            >
                            <button class="btn btn-primary">Checkout</a>
                        </form>
                    <?php endif; ?>
                </div>
                
            </div>

            <!-- footer -->
            <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                <div class="text-muted small">© 2022 <a href="/" class="text-muted">My Store</a></div>
                <div class="d-flex align-items-center gap-3">
                    <a href="/login" class="btn btn-light btn-sm">Login</a>
                    <a href="/signup" class="btn btn-light btn-sm">Sign Up</a>
                    <a href="/orders" class="btn btn-light btn-sm">My Orders</a>
                </div>
            </div>

        </div>
        
<?php

    require "parts/footer.php";