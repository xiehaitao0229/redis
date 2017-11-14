<?php

//实例化
$redis = new Redis();
//连接服务器
$redis->connect("127.0.0.1");
//授权
$redis->auth("haitao");
//相关操作
$redis->set("name","haitao");
$data = $redis->key("*");
var_dump($data);
