# create-order-length-php
[![Build Status](https://travis-ci.org/medz/create-order-length-php.svg?branch=master)](https://travis-ci.org/medz/create-order-length-php)
[![StyleCI](https://styleci.io/repos/71053488/shield?branch=master)](https://styleci.io/repos/71053488)

## 概述
这个包是用于生成指定字符队中再指定长度内的所有不重复组合

## 获取？
 - Composer:
  `composer require medz/create-order-length-php`
 
 - source code:
  下载这个包，并在你的加载中include`bootstrap.php`即可.
 
## 如何使用：
```php
<?php

use Medz\Component\CreateOrderLength;

// 用于存储实例中生成的数据
$arr = array();

// 构造方法中支持快速设置需要的各个参数。
// $cls = new CreateOrderLength([int $length = 1 | array [int $lrngth = 1, bool $isStaticLength = false]], array $keys = [...]);
$cls = new CreateOrderLength();

// 设置生成的最大长度
// $cls->setLength(int $length, [bool $isStaticLength = false])
$cls->setLength(3);

// 设置回调方法，传入匿名函数
$cls->setCallable(function ($str) use (&$arr) {
  array_push($arr, $str);
});

// 设置用于生成字符串的字符组合
// 默认值是a-z0-9
// $cls->setKeys(array(...))

// 开始生成
// 支持设置前置字符串，前置字符串将会被计算到长度当中。
// $cls->start([$pre])
$cls->start();

```
