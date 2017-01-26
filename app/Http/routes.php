<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@viewHomePage']);
    Route::get('login', ['as' => 'login', 'uses' => 'UserController@viewLoginForm']);
    Route::post('processLogin', ['as' => 'process_login', 'uses' => 'UserController@processLogin']);
    Route::post('registerUser', ['as' => 'register_user', 'uses' => 'UserController@registerUser']);
    Route::get('getUsersList/{user_type}', ['as' => 'users_list', 'uses' => 'UserController@getUsersList']);
    Route::get('getOrdersList', ['as' => 'users_list', 'uses' => 'OrdersController@loadOrders']);
    Route::get('getCouriersList', ['as' => 'users_list', 'uses' => 'CourierController@loadCouriers']);
    Route::get('roles', ['as' => 'roles_list', 'uses' => 'UserController@getRoles']);
    Route::post('roles', ['as' => 'roles_list', 'uses' => 'UserController@addRoles']);
    Route::get('permissions', ['as' => 'permissions_list', 'uses' => 'UserController@getPermissions']);
    Route::post('permissions', ['as' => 'permissions_list', 'uses' => 'UserController@addPermissions']);
    Route::get('dashboard/roles', ['as' => 'roles', 'uses' => 'UserController@viewRoles']);
    Route::get('dashboard/role/{role_id}/permission', ['as' => 'assign_permission', 'uses'=>'UserController@assignPermission']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@viewDashboard']);
    Route::post('assignPermissions', ['as' => 'assign_permissions', 'uses' => 'UserController@assignPermissionToRole']);
    Route::post('orders/add', ['as' => 'add_order', 'uses' => 'OrdersController@addOrder']);
    Route::post('dashboard/couriers/add', ['as' => 'add_order', 'uses' => 'CourierController@addCourier']);
    Route::get('dashboard/permissions', ['as' => 'permissions', 'uses' => 'UserController@viewPermissions']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@doLogout']);
    Route::get('dashboard/{user_type}/list', ['as' => 'clients', 'uses' => 'UserController@loadUsersList']);
    Route::get('dashboard/orders/all', ['as' => 'orders', 'uses' => 'OrdersController@fetchOrdersList']);
    Route::get('dashboard/couriers/all', ['as' => 'orders', 'uses' => 'CourierController@fetchCouriersList']);
    Route::get('dashboard/orders/add', ['as' => 'orders', 'uses' => 'OrdersController@loadAddOrderForm']);
    Route::get('dashboard/couriers/add', ['as' => 'orders', 'uses' => 'CourierController@loadAddCourierForm']);
});
