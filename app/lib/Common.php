<?php
namespace App\Lib;

/**
 *
 * Common.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-28
 */
class Common
{
    /**
     * @param $maxpage  总数
     * @param $size  每页显示数
     * @param $page    当前页
     * @param string $para 翻页参数(不需要写$page),如http://www.example.com/article.php?page=3&id=1，$para参数就应该设为'&id=1'
     * @return string  返回的输出分页html内容
     */
    public static function pagination($counts, $take = 20, $page = 1, $para = '')
    {
        $multipage = '';  //输出的分页内容
        $listnum = 5;     //同时显示的最多可点击页面
        $maxpage = ceil($counts / $take);
        if ($maxpage < 2) {
            return '';
        } else {
            $offset = 2;
            if ($maxpage <= $listnum) {
                $from = 1;
                $to = $maxpage;
            } else {
                $from = $page - $offset; //起始页
                $to = $from + $listnum - 1;  //终止页
                if ($from < 1) {
                    $to = $page + 1 - $from;
                    $from = 1;
                    if ($to - $from < $listnum) {
                        $to = $listnum;
                    }
                } elseif ($to > $maxpage) {
                    $from = $maxpage - $listnum + 1;
                    $to = $maxpage;
                }
            }

            $multipage .= ($page - $offset > 1 && $maxpage >= $page ? '<li><a href="?page=1' . $para . '" >1...</a></li>' : '') .
                ($page > 1 ? '<li><a href="?page=' . ($page - 1) . $para . '" >&laquo;</a></li>' : '');

            for ($i = $from; $i <= $to; $i++) {
                $multipage .= $i == $page ? '<li class="active"><a href="?page=' . $i . $para . '" >' . $i . '</a></li>' : '<li><a href="?page=' . $i . $para . '" >' . $i . '</a></li>';
            }

            $multipage .= ($page < $maxpage ? '<li><a href="?page=' . ($page + 1) . $para . '" >&raquo;</a></li>' : '') .
                ($to < $maxpage ? '<li><a href="?page=' . $maxpage . $para . '" class="last" >...' . $maxpage . '</a></li>' : '');
            $multipage .= ' <li><a href="#" ><input type="text" size="3"  onkeydown="if(event.keyCode==13) {self.window.location=\'?page=\'+this.value+\'' . $para . '\'; return false;}" ></a></li>';


            $multipage = $multipage ? '<ul class="pagination">' . $multipage . '</ul>' : '';
        }

        return $multipage;
    }

    /**
     * 返回配置内容
     * 默认配置为 array形式
     * @param null $name
     * @return bool|mixed
     */
    public static function config($name = null){
        if(empty($name)) return false;
        $file = @require_once BASE_PATH.'/config/'.$name.'.php';
        return (array)$file;
    }

}