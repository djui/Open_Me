<?PHP

	echo ' 2 + 3 = ' . antyspam('2 + 3') . "\n";
	
	/* Only polish 
	   eq: http://www.polishforums.com/archives/2009/general-language-17/numbers-polish-language-6722/
	
	*/
	
	echo ' dwa razy czterdzieœci = ' . antyspam('dwa razy czterdzieœci') . "\n";
	
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
				'dziesiêæ' => 10, 'jedenaœcie' => 11, 'dwanaœcie' => 12,'trzynaœcie' => 13,'czternaœcie' => 14,'piêtnaœcie' => 15,'szesnaœcie' => 16,
				'siedemnaœcie' => 17,'osiemnaœcie' => 18,'dziewiêtnaœcie' => 19,'zero' => 0);
	
			$zamien3 = array('jeden' => 1,'dwa' => 2,'trzy' => 3,'cztery' => 4,'piêæ' => 5,'szeœæ' => 6,'siedem' => 7,'osiem' => 8,'dziewiêæ' => 9);
			
			$wiecej = array("dwadzieœcia" => 20,"trzydzieœci" => 30, "czterdzieœci" => 40,
							"piêædziesi¹t" => 50, "szeœædziesi¹t" => 60, "siedemdziesi¹t" => 70,
							"osiemdziesi¹t" => 80, "dziewiêædziesi¹t" => 90);
	
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