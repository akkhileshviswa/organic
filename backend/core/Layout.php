<?php
    Routes::get(['url' => 'home', 'controller' => 'Controller', 'method' => 'loadLogin']);   
    Routes::get(['url' => 'dashboard', 'controller' => 'Controller', 'method' => 'loadDashboard']);   
    Routes::get(['url' => 'customers', 'controller' => 'Controller', 'method' => 'loadCustomers']);   
    Routes::get(['url' => 'orders', 'controller' => 'Controller', 'method' => 'loadOrders']);   
    Routes::get(['url' => 'products', 'controller' => 'Controller', 'method' => 'loadProducts']);  
    Routes::get(['url' => 'newproduct', 'controller' => 'Controller', 'method' => 'newProduct']);

    Routes::post(['url' => 'home', 'controller' => 'Controller', 'method' => 'loginUser']);

    Routes::post(['url' => 'updateproduct', 'controller' => 'Controller', 'method' => 'updateProduct']);
    Routes::post(['url' => 'products', 'controller' => 'Controller', 'method' => 'updateEditedProduct']);
    Routes::post(['url' => 'createproduct', 'controller' => 'Controller', 'method' => 'createProduct']);
    
    Routes::post(['url' => 'updatescustomer', 'controller' => 'Controller', 'method' => 'updateCustomer']);
    Routes::post(['url' => 'customers', 'controller' => 'Controller', 'method' => 'updateEditedCustomer']);

    Routes::post(['url' => 'orders', 'controller' => 'Controller', 'method' => 'changeOrderStatus']);
    Routes::post(['url' => 'orderstatus', 'controller' => 'Controller', 'method' => 'removeOrder']);