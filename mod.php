<?php
  require("redis.php");
  $uid = $_GET['id'];
  $data = $redis->hgetall("user:".$uid);
?>
<form action="doedit.php" method="post">
    <input type="hidden" value="<?php echo $data['uid']?>" name="uid"/>
    用户名：<input type="text" name="username" value="<?php echo $data['username']?>"/><br/>
    年龄：<input type="text" name="age" value="?php echo $[data['age']?>"/><br/>
    <input type="submit" value="修改"/>
    <input type="reset" value="重新填写"/>
</form>