<?PHP

	echo ' 2 + 3 = ' . antyspam('2 + 3') . "\n";
	
	/* Only polish 
	   eq: http://www.polishforums.com/archives/2009/general-language-17/numbers-polish-language-6722/
	
	*/
	
	echo ' dwa razy czterdzie�ci = ' . antyspam('dwa razy czterdzie�ci') . "\n";
	
	echo ' 2 * 13 = ' . antyspam('2 * 13') . "\n";


	sleep(5);

	
	function antyspam($str) {


			$str = str_replace('):','@',$str);
				
			$str = str_replace(array('pytanie:','=','?','ie:',"ik:",":"),'',$str);
			

			##$str = preg_replace("/[^0-9)()\*=\+-\@]/i", '', $str); / hmm wtf
	
			
			$str = str_replace('@','):',$str);
			
			$str = trim($str);

			
			
			$zamien2 = array('minus' => '-','razy' => '*','plus' => '+');
			
			$zamien  = array(
				'dziesi��' => 10, 'jedena�cie' => 11, 'dwana�cie' => 12,'trzyna�cie' => 13,'czterna�cie' => 14,'pi�tna�cie' => 15,'szesna�cie' => 16,
				'siedemna�cie' => 17,'osiemna�cie' => 18,'dziewi�tna�cie' => 19,'zero' => 0);
	
			$zamien3 = array('jeden' => 1,'dwa' => 2,'trzy' => 3,'cztery' => 4,'pi��' => 5,'sze��' => 6,'siedem' => 7,'osiem' => 8,'dziewi��' => 9);
			
			$wiecej = array("dwadzie�cia" => 20,"trzydzie�ci" => 30, "czterdzie�ci" => 40,
							"pi��dziesi�t" => 50, "sze��dziesi�t" => 60, "siedemdziesi�t" => 70,
							"osiemdziesi�t" => 80, "dziewi��dziesi�t" => 90);
	
			$str = strtr($str, $zamien);
			$str44 = $str;
	
			foreach ( $wiecej as $nazwa => $ile ) :
				$zam = array();
				foreach ( $zamien3 as $n => $n2  ) :
						$zam[$nazwa . $n] = $n2 + $ile;
				endforeach;
				$str = strtr($str ,$zam);
			endforeach;
	
			$str = strtr($str ,$wiecej);
			$str = strtr($str ,$zamien3);
			$str = strtr($str ,$zamien2);
			
			$str = str_replace(array("\n","\r"),'',$str);
			
			$str = str_replace(array(":","(",")","=",',',),array("/","","","",'.'),$str);

		 	
		 	$str = addslashes($str);


			return calc_string("$str");
						
	}	
	
	
	

	function calc_string( $mathString )	{
			@$cf_DoCalc = @create_function("", "return (" . @$mathString . ");" );
			return @$cf_DoCalc();
	}
	
?>