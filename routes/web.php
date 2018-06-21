<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Generate Application Key
$router->get('/key', function () {
    return str_random(32);
});

// Basic GET and POST Request
$router->get('foo', function () {
    return 'Hello, GET Method!';
});

$router->post('bar', function () {
    return 'Hello, POST Method!';
});

// The router allows you to register routes that respond to any HTTP verb:
$router->get('/get', function () {
    return 'GET';
});
$router->post('/post', function () {
    return 'POST';
});
$router->put('/put', function () {
    return 'PUT';
});
$router->patch('/patch', function () {
    return 'PATCH';
});
$router->delete('/delete', function () {
    return 'DELETE';
});
$router->options('/options', function () {
    return 'OPTIONS';
});

// Basic Route Parameter
$router->get('user/{id}', function ($id) {
    return 'User ' . $id;
});
$router->get('post/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return "Post ID = {$postId} <br> Comment ID = {$commentId}";
});
// Optional Route Parameter
$router->get('optional[/{param}]', function ($param = null) {
    return $param;
});

// Named Route
$router->get('profile', ['as' => 'profile', function () {
    return 'profile route name : ' . route('profile');
}]);
$router->get('profile/action', [
    'as' => 'profile.action',
    'uses' => 'ExampleController@getProfile'
]);

// Route Group
// - Middleware
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', function ()    {
        // Uses Auth Middleware
    });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
});

// - Namespaces
$router->group(['namespace' => 'Admin'], function() use ($router)
{
    // Using The "App\Http\Controllers\Admin" Namespace...

    $router->group(['namespace' => 'User'], function() use ($router) {
        // Using The "App\Http\Controllers\Admin\User" Namespace...
    });
});

// - Prefix
$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('users', function ()    {
        // Matches The "/admin/users" URL
    });
});