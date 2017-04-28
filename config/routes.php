<?php
use NoahBuscher\Macaw\Macaw;


Macaw::get('home', 'App\Controllers\HomeController@home');
Macaw::get('user', 'App\Controllers\UserController@index');
Macaw::error(function() {

    throw new Exception("404 Not Found");

});
Macaw::dispatch();