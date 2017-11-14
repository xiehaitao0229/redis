<a href="add.php">注册</a>
<?php
require("redis.php");
if(!emptyempty($_COOKIE['auth'])){
    $id = $redis->get("auth:".$COOKIE['auth']);
    $name = $redis->hget("user:".$id,"username");
    ?>
    欢迎您，<?php echo $name?>,<a href="logout.php">退出</a>
    <?php
}else{
    ?>
    <a href="login.php">登陆</a>
    <?php
}
//用户总数
$count = $redis->lsize("uid");

//页大小
$page_size = 3;

//当前页码
$page_num = (!emptyempty($_GET['page']))?$_GET['page']:1;

//页总数
$page_count = ceil($count/$page_size);

$ids = $redis->lrange("uid",($page_num-1)*$page_size,(($page_num-1)*$page_size+$page_size-1));

//var_dump($ids);
foreach($ids as $v){
    $data[] = $redis->hgetall("user:".$v);
}

//var_dump($data);
//$data = array_filter($data);
?>
<table border="1">
    <tr>
        <th>uid</th>
        <th>username</th>
        <th>age</th>
        <th>操作</th>
    </tr>
    <?php foreach($data as $v){?>
        <tr>
            <td><?php echo $v['uid']?></td>
            <td><?php echo $v['username']?></td>
            <td><?php echo $v['age']?></td>
            <td>
                <a href="del.php?id=<?php echo $v['uid']?>">删除</a>
                <a href="mod.php?id=<?php echo $v['uid']?>">编辑</a>
                <?php if(!emptyempty($_COOKIE['auth']) && $id!=$v['uid']){?>
                    <a href="addfans.php?id=<?php echo $v['uid']?>&uid=<?php echo $id?>">加关注</a>
                <?php } ?>
            </td>
        </tr>
    <?php}?>
    <tr>
        <td colspan="4">
            <a href="?page=<?php echo(($page_num-1)<=1)?1:($page_num-1) ?>">上一页</a>
            <a href="?page=<?php echo(($page_num+1)>=$page_count)?$page_count:($page_num+1) ?>">下一页</a>
            <a href="?page=1">首页</a>
            <a href="?page=<?php echo $page_count ?>">尾页</a>
            当前<?php echo $page_num ?>页
            总共<?php echo $page_count ?>页
            总共<?php echo $count ?>个用户
        </td>
    </tr>
</table>

<table border=1>
    <caption>我关注了谁</caption>
    <?php $data = $redis->smembers("user:".$id.":following");?>
    <?php
    foreach($data as $v) {
        $row = $redis->hgetall("user:".$v);
    ?>

    <tr>
        <td><?php echo $row['uid']?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['age']?></td>
    </tr>
    <?php
    }
    ?>
</table>

<table border=1>
    <caption>我的粉丝</caption>
    <?php
    $data = $redis->smembers("user:".$id.":followers");
    foreach($data as $v) {
    $row = $redis->hgetall("user:".$v);
    ?>
    <tr>
        <td><?php echo $row['uid']?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['age']?></td>
    </tr>
    <?php
    }
    ?>
</table>