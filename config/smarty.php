<?php
/**
 *
 * smarty.php
 *
 * @author   jinghh@273.cn
 * @time     2017-04-28
 */
return [
    'caching' => false,//是否使用缓存
    'template_dir' => VIEW_PATH,//设置编译目录
    'compile_dir' => STORAGE_PATH . "/compile/",//设置模板目录
    'cache_dir' => STORAGE_PATH . "/cache/",//缓存文件夹
    'left_delimiter' => "{",//修改左右边界符号
    'right_delimiter' => "}"
];