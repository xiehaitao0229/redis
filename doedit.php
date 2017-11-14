<?php
$uid = $_POST['uid'];
$username = $_POST['username'];
$age = $_POST['age'];
$a = $redis->hmset("user:".$uid,array("username"=>$username,"age"=>$age));
if($a) {
    header("location:list.php");
}else {
    header("location:mod.php?id=".$uid);
   }