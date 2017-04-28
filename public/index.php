<?php
header("Content-type:text/html;charset=utf-8");
// 启动器

require dirname(dirname(__FILE__)).'/bootstrap/bootstrap.php';

define('VIEW_PATH', BASE_PATH.'/resources/views/');

define('STORAGE_PATH', BASE_PATH.'/storage/');

// 路由配置、开始处理

require BASE_PATH.'/config/routes.php';