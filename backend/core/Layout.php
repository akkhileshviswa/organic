<?php
    /**
     * URL mapping for get request.
     */
    Routes::get(['url' => 'home', 'controller' => 'Controller', 'method' => 'loadLogin']);   
    Routes::get(['url' => 'dashboard', 'controller' => 'Controller', 'method' => 'loadDashboard']);   
    Routes::get(['url' => 'customers', 'controller' => 'Controller', 'method' => 'loadCustomers']);   
    Routes::get(['url' => 'orders', 'controller' => 'Controller', 'method' => 'loadOrders']);   
    Routes::get(['url' => 'products', 'controller' => 'Controller', 'method' => 'loadProducts']);  
    Routes::get(['url' => 'newproduct', 'controller' => 'Controller', 'method' => 'newProduct']);

    /**
     * URL mapping for login page post request.
     */
    Routes::post(['url' => 'home', 'controller' => 'Controller', 'method' => 'loginUser']);

    /**
     * URL mapping for product page post request.
     */
    Routes::post(['url' => 'updateproduct', 'controller' => 'Controller', 'method' => 'updateProduct']);
    Routes::post(['url' => 'products', 'controller' => 'Controller', 'method' => 'updateEditedProduct']);
    Routes::post(['url' => 'createproduct', 'controller' => 'Controller', 'method' => 'createProduct']);
    
    /**
     * URL mapping for customer page post request.
     */
    Routes::post(['url' => 'updatescustomer', 'controller' => 'Controller', 'method' => 'updateCustomer']);
    Routes::post(['url' => 'customers', 'controller' => 'Controller', 'method' => 'updateEditedCustomer']);

    /**
     * URL mapping for order page post request.
     */
    Routes::post(['url' => 'orders', 'controller' => 'Controller', 'method' => 'changeOrderStatus']);
    Routes::post(['url' => 'orderstatus', 'controller' => 'Controller', 'method' => 'removeOrder']);