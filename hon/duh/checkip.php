<?php
	$tg=time();
	$tgout=900;
	$tgnew=$tg - $tgout;
		
	$ip = $_GET["ip"];
	$path = $_GET["path"];
	
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("test",$conn);
	

	$sql="insert into useronline(tgtmp,ip,local) values('".$tg."','".$ip."','".$path."')";
	$query=mysql_query($sql);
		
	$sql="delete from useronline where tgtmp < $tgnew";
	$query=mysql_query($sql);
		
		
	$sql="SELECT DISTINCT ip FROM useronline where local='".$path."';";
	$query=mysql_query($sql);
	$user = @mysql_num_rows($query);
	if($user > 1)
	{
		exit("NO");
	}
?>