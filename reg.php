<?php

require ("redis.php");

$username = $_POST['username'];
$password = $_POST['password'];
$age = $_POST['age'];

echo $uid = $redis->incr('userid');

$redis->hMset('user:'.$uid,array("uid"=>$uid,"username"=>$username,"password"=>$password,"age"=>$age));

$redis->rPush("uid",$uid);  //  存入list中

$redis->set('username'.$username,$uid);

header("location:list.php");
