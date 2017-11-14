<?php
$id = $_GET['id'];
$uid = $_GET['uid'];
require("redis.php");
$redis->sadd("user:".$uid.":following",$id);
$redis->sadd("user:".$id.":followers",$uid);
header("location:list.php");