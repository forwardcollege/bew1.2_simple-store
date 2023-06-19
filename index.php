<?php

  session_start();

  require 'includes/functions.php';
  require 'includes/class-db.php';

  // get route from the global variable $_SERVER
  $path = $_SERVER["REQUEST_URI"];

  // remove beginning slash & ending slash
  $path = trim( $path, '/' );

  // remove all the URL parameters that starts from ?
  $path = parse_url( $path, PHP_URL_PATH );

  switch( $path ) {
    case 'auth/login':
        require 'includes/auth/login.php';
        break;
    case 'auth/signup':
        require 'includes/auth/signup.php';
        break;
    case 'products/add_to_cart':
        require 'includes/products/add_to_cart.php';
        break;
    case 'products/remove_from_cart':
        require 'includes/products/remove_from_cart.php';
        break;
    case 'products/checkout':
        require 'includes/products/checkout.php';
        break;
    case 'login':
        require "pages/login.php";
        break;
    case 'signup':
        require "pages/signup.php";
        break;
    case 'cart':
        require "pages/cart.php";
        break;
    case 'orders':
        require "pages/orders.php";
        break;
    case 'logout':
        require "pages/logout.php";
        break;
    default:
        require "pages/home.php";
        break;
  }