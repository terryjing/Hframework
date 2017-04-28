<?php
namespace App\Controllers;

/**
 *
 * HomeController.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-27
 */
class HomeController extends BaseController
{
    public function home()
    {
        $this->assign('a', "<h1>控制器成功！</h1>" ) ;
        $this->display('home/home.tpl');
    }

}