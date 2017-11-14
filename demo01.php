<?php
//  1.实例化对象
$redis = new Redis();

//  2.定义主机和端口
$host = '127.0.0.1';
$port = 6379;

//  3.连接redis服务器
$redis->connect($host,$port);

$name = $redis->get('name');

echo $name;