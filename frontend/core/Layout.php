<?php
    /**
     * URL mapping for get request of user and cart controller.
     */
    Routes::get(['url' => 'user', 'controller' => 'Usercontroller', 'method' => 'loadUser']);
    Routes::get(['url' => 'cart', 'controller' => 'CartController', 'method' => 'loadCart']);
    Routes::get(['url' => 'home', 'controller' => 'Usercontroller', 'method' => 'loadHome']);
    Routes::get(['url' => 'myaccount', 'controller' => 'Usercontroller', 'method' => 'showUserDetails']);
    Routes::get(['url' => 'checkout', 'controller' => 'Cartcontroller', 'method' => 'loadCheckout']);
    Routes::get(['url' => 'logout', 'controller' => 'Usercontroller', 'method' => 'userLogout']);
    
    /**
     * URL mapping for user controller post request.
     */
    Routes::post(['url' => 'home', 'controller' => 'Usercontroller', 'method' => 'loginCheck']);
    Routes::post(['url' => 'login', 'controller' => 'UserController', 'method' => 'loginUser']);
    Routes::post(['url' => 'register', 'controller' => 'UserController', 'method' => 'registerUser']);
    Routes::post(['url' => 'updatepassword', 'controller' => 'Usercontroller', 'method' => 'updatePassword']);
    Routes::post(['url' => 'updateaddress', 'controller' => 'Usercontroller', 'method' => 'updateAddress']);
    
    /**
     * URL mapping for cart page cart controller post request.
     */
    Routes::post(['url' => 'updatequantity', 'controller' => 'Cartcontroller', 'method' => 'updateQuantity']);
    Routes::post(['url' => 'removecartitem', 'controller' => 'Cartcontroller', 'method' => 'removeCartItem']);
    Routes::get(['url' => 'updatecart', 'controller' => 'Cartcontroller', 'method' => 'updateCart']);
    
    /**
     * URL mapping for checkout page cart controller post request.
     */
    Routes::post(['url' => 'orderdetails', 'controller' => 'Cartcontroller', 'method' => 'checkoutDetails']);
    Routes::post(['url' => 'checkouttotal', 'controller' => 'Cartcontroller', 'method' => 'checkoutTotal']);