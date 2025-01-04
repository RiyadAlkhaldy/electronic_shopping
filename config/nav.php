<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Dashboard',
        'route' => 'dashboard.dashboard',
        'badge' => 'New',
        'active' => 'dashboard.dashboard',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'title' => 'Categories',
        'route' => 'dashboard.categories.index',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Products',
        'route' => 'dashboard.products.index',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view',
    ],
   
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Roles',
        'route' => 'dashboard.roles.index',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view',
    ],
    [
        'icon' => 'far fa-users nav-icon',
        'title' => 'Users',
        'route' => 'dashboard.users.index',
        'active' => 'dashboard.users.*',
        'ability' => 'users.view',
    ],
    [
        'icon' => 'far fa-users nav-icon',
        'title' => 'Admins',
        'route' => 'dashboard.admins.index',
        'active' => 'dashboard.admins.*',
        'ability' => 'admins.view',
    ],

    // [
    //     'icon' => 'far fa-circle nav-icon',
    //     'title' => 'Orders',
    //     'route' => 'dashboard.categories.index',
    //     'active' => 'dashboard.orders.*',
    //     'ability' => 'orders.view',
    // ],



];
