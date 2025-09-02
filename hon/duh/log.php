<HEAD> <META HTTP-EQUIV=REFRESH CONTENT=5> </HEAD>
<?php
	$i = 1;
	while($i < 30)
	{
		if(md5("version4_log_".$i.".txt") == $_REQUEST["md5"])
		{
			$log = "version4_log_".$i.".txt";
			break;
		}
		$i++;
	}
	
	if(!isset($log))
	{
		exit("md5 is invalid");
	}
	$handle = @fopen($log,"r");
	$i = 0 ; $j = 0;
	while(!feof($handle))
	{

		$result = explode("|",@fgets($handle));
		if(!strpos($result[1],"K"))
		{
			$false[$i] = $result[0]." => ".$result[1];
			$i++;
		}
		else
		{
			$true[$j] = $result[0]." => ".$result[1];
			$j++;
		}
	}
	@fclose($handle);
	

	echo "<select multiple rows=10>";
	while($i >= 0)
	{
		echo "<option>".$false[$i]."</option>";
		$i--;
	}
	echo "</select><br>";
	while($j >= 0)
	{
		echo $true[$j]."<br>";
		$j--;
	}
	
?>