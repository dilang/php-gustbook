<?php
/*****************************
*数据库连接
*****************************/
$conn = @mysql_connect("localhost","root","mjz1990");
if (!$conn){
	die("连接数据库失败：" . mysql_error());
}
mysql_select_db("test", $conn);
?>
