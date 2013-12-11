<?PHP

	/* 
		Compress php eq when save template to memory
		eq from Blitz templates 
	*/

	function compre($buffer) {
	
	    $buffer = preg_replace('/\s+/', ' ', $buffer);
	    $buffer = str_replace(array("\t","\x0B","\r\n"),'', $buffer);
	    $buffer = @ereg_replace("//[\x20-\x7E]*\n", '', $buffer);
		$buffer = @ereg_replace("#[\x20-\x7E]*\n", '', $buffer);
		$buffer = @ereg_replace("\t|\n", '', $buffer);
	
		return $buffer;
	}




?>