<?php
/*****************************
*���ݿ�����
*****************************/
$conn = @mysql_connect("localhost","root","mjz1990");
if (!$conn){
	die("�������ݿ�ʧ�ܣ�" . mysql_error());
}
mysql_select_db("test", $conn);
?>
