<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;

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

$router->post('/auth/login', [
    // que use nuestro AuthController
    'uses'=> 'AuthController@authenticate'
]);


// hacemos un router group, al que pasamos un middleware al que llamaremos jwt.auth
$router->group(
    ['middleware'=>'jwt.auth'], 
    // usamos el router
    function () use ($router){
        // dentro ponemos todas las rutas protegidas
        $router->get('/users', 'UserController@index');
        $router->get('/users/{id}', 'UserController@show');
        $router->delete('/users/{id}', 'UserController@destroy');
        $router->put('/users/{id}', 'UserController@update');
        $router->post('/users', 'UserController@store');
    }
);