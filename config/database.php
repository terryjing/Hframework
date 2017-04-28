<?php
/**
 *
 * database.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-27
 */
return [
    //数据库根据read write可以开启读写分离
    'read' => array(
        //'host' => '192.168.115.128',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'prefix' => 'ecs_',
    ),
    'write' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'prefix' => 'ecs_',
    ),
    'driver' => 'mysql',
    'database' => 'ec',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci'
];