<?php
/*****************************
* admin.php ��̨������ҳ���ļ�
*****************************/
session_start();
// δ��¼���ض��򵽵�½ҳ��
if(!isset($_SESSION['username'])){
	header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/login.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>���</title>
</head>
<body>
<?php
require("./conn.php");
require("./config.php");

$p = $_GET['p']?$_GET['p']:1;
$offset = ($p-1)*$pagesize;
$query_sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT  $offset , $pagesize";
$result = mysql_query($query_sql);
if(!$result) exit('��ѯ���ݴ���'.mysql_error());

// ѭ�������ǰҳ��ʾ����
while($gb_array = mysql_fetch_array($result)){
    echo $gb_array['nickname'],'&nbsp;';
    echo '�����ڣ�',date("Y-m-d H:i:s", $gb_array['createtime']);
	echo ' ID�ţ�',$gb_array['id'],'<br />';
    echo '���ݣ�',nl2br($gb_array['content']),'<br />';
	
?>
<div id="reply">
<form id="form1" name="form1" method="post" action="reply.php">
<p><label for="reply">�ظ���������:</label></p>
<textarea id="reply" name="reply" cols="40" rows="5"><?=$gb_array['reply']?></textarea>
<p>
<input name="id" type="hidden" value="<?=$gb_array['id']?>" />
<input type="submit" name="submit" value="�ظ�����" />
<a href="reply.php?action=delete&id=<?=$gb_array['id']?>">ɾ������</a>
</p>
</form>
</div>
<?
	echo "<hr />";
}
//��������ҳ��
$count_result = mysql_query("SELECT count(*) FROM guestbook3");
$count_array = mysql_fetch_array($count_result);
$pagenum=ceil($count_array['count(*)']/$pagesize);
echo '�� ',$count_array['count(*)'],' ������';
if ($pagenum > 1) {
	for($i=1;$i<=$pagenum;$i++) {
		if($i==$p) {
			echo '&nbsp;[',$i,']';
		} else {
			echo '&nbsp;<a href="admin.php?p=',$i,'">'.$i.'</a>';
		}
	}
}
?>
</body>
</html>