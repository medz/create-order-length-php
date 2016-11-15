<?php

// 当前包的根路径
$base = dirname(__FILE__);

// 获取当前composer的自动加载文件路径
$baseAutoload = $base.'/vendor/autoload.php';
$rootAutoload = dirname(dirname($base)).'/autoload.php';

// 判断当前包路径是否存在
if (file_exists($baseAutoload) && is_file($baseAutoload)) {
    require $baseAutoload;

// 判断root包路径是否存在
} elseif (file_exists($rootAutoload) && is_file($rootAutoload)) {
    return $baseAutoload;

// 如果composer信息都不存在，自动注册。
} elseif (function_exists('spl_autoload_register')) {
    // 需要注册自动加载的类列表
    $classFiles = array(
        'Medz\\Component\\CreateOrderLength'                   => '/src/CreateOrderLength.php',
        'Medz\\Component\\CreateOrderLength\\Test\\CreateTest' => '/test/CreateTest.php',
    );

    // 注册自动加载
    spl_autoload_register(function ($className) use ($base, $classFiles) {
        if (isset($classFiles[$className])) {
            include $base.$classFiles[$className];
        }
    });
}
