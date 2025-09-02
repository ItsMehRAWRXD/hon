<?php
	class exploit1
	{
		private $option = 123;
		private $url;
		private $countColumn;
		private $exploitColumn;
		private $commentBypass;
		private $encodeBypass;
		private $x = 123;
		public function addVar($var,$value)
		{
			$this->$var = $value;
		}
		public function printVar($var)
		{
			echo $this->$var;
		}
	}

	$a = new exploit1();
	$a->addVar("option","table");
	$a->printVar("option");
?>