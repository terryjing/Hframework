<?php
namespace App\Controllers;

/**
 *
 * BaseController.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-27
 */
use App\Lib\Common;
use SmartyBC;
class BaseController extends SmartyBC
{
    public $_pageSize = 20;

    public function __construct($options = [])
    {
        parent::__construct($options);
        $smartyCon = Common::config('smarty');
        $this->_setSmarty($smartyCon);
        $this->assign('WEB_PATH', WEB_PATH);
        $this->assign('VIEW_PATH', VIEW_PATH);
        $this->assign('STORAGE_PATH', STORAGE_PATH);
    }
    public function _setSmarty($config = []){
        $config = (array) $config;
        if(!empty($config)){
            foreach($config as $k => $cg){
                $this->$k = $cg;
            }
        }

    }

}