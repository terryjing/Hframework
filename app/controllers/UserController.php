<?php
namespace App\Controllers;

/**
 *
 * UserController.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-27
 */
use App\Lib\Params;
use App\Models\User;
use App\Lib\Common;

class UserController extends BaseController
{

    public function index()
    {
        $this->_pageSize = 2;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $take = isset($_GET['take']) ? (int)$_GET['take'] : $this->_pageSize;
        $skip = (int)($page-1) * $take;
        $counts = User::all()->count();
        $users = User::skip($skip)->take($take)->get();
        $this->assign('users', $users);

        $this->assign('pagination', Common::pagination($counts, $take, $page));
        $this->display('user/user.tpl');
    }


}