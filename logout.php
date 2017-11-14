<?php
setcookie("auth","",time()-1);
header("location:list.php");