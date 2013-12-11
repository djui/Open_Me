<?PHP


	@set_time_limit(0); 
	$db = new SQLite3('cfg/main.db');
	include('class.php');
	error_reporting(0);
	#file_put_contents('cfg/cookie.txt','');
	
	$kra = new crakand;
	
	$ini = parse_ini_file("cfg/cfg.ini");
	
	/* Pobieranie linkow */
	
	$f3 = fopen('linkuj.txt',"r");
	$strony = array();

	while ($k3 = fgets($f3)){
		
		$k3 = preg_replace("/[\t|\n|\r]/", "", $k3);
		if ( empty($k3) ) continue;
		$strony[] = $k3;
			
	}

	/* END pobieranie linkow */
	
	

	$q = $db->query("SELECT * FROM fusion WHERE active = 0  ORDER BY RANDOM() ");

	
	$qd = $db->query("SELECT COUNT(*) AS ile FROM fusion WHERE active = 0");
	$qr = $db->query("SELECT COUNT(*) AS ile FROM fusion WHERE active = 1");
	
	$iled = $qr->fetchArray(SQLITE3_ASSOC);
	$ile = $qd->fetchArray(SQLITE3_ASSOC);

	echo 'Nowych kont: ' . $ile['ile'] . "\n";
	echo 'Dzialajacych kont: ' . $iled['ile'] . "\n";
	
	/* Pobieranie e-maili z srevera */
	
	if ( $ini['dziala'] == 'Y' ) {

		$mbox = @imap_open("{". $ini['smtp']  ."}INBOX", "". $ini['email'] ."", "". $ini['haslo'] ."") ;
	
		if ( $mbox == false ) :
				echo  "\n\n" .'  Program nie mogl polaczyc sie serwerem pocztowym. Sprawdz konfiguracje ponownie' . "\n\n\n\n\n";
				die;

		endif; 
		
		$ilosc = imap_num_msg($mbox);
		
		echo 'Do aktywacji: ' . $ilosc . "\n\n\n";
		
		
		for($i = 1; $i <= $ilosc; $i++) {
			$header = imap_headerinfo($mbox, $i);
			
			#echo $header->Subject . "\n";
			
			$raw_body = imap_body($mbox, $i);
			
			if ( preg_match('#http:\/\/.*?\n\r#si', $raw_body, $wyn) ) :
							$wyn[0] = preg_replace("/[\n\r]/","",$wyn[0]);
			
							$asd = $kra->GetContent($wyn[0]);
							echo short_url2($wyn[0]) . "\n\n";


							#file_put_contents('_TEST/' . rand(00,9999999) . '.html', $wyn[0] . $asd);
			endif;
			
			if ( preg_match_all('#.*?: .*?\n#', $raw_body, $enf) ) :
			
					foreach ( $enf[0] as $res ) :
							echo $res;
							
					endforeach;
			
			endif;
			
			imap_delete($mbox, $i);
			
			echo "\n";
			
			
			#print_r($raw_body);
			#die;
		}
		
		
		
		


	} else {
			echo 'Brak skonfigurowanej poczty';
			sleep(20);
			die;
	
	}

	
	/* END pobieranie e-maili z servera */
	

	
	/* Aktywowanie kont */

	
	while ($row = $q->fetchArray(SQLITE3_ASSOC)) {

	
			$kra->post_vars = array('user_name' => $row['user'], 'user_pass' =>  $row['pass'] , 'remember_me' => 'y',  'login' => 'Zaloguj' );
		
			$kra->curl_header = 1;
		
			$contenet = $kra->GetContent($row['url'] . 'news.php', true);

			$cgy = $kra->GetContent($row['url'] . 'edit_profile.php');
			
			@preg_match("@[A-Za-z0-9]{32}@",$cgy, $hash);


			//http://www.uwm.edu.pl/knph/members.php
		
			if ( strstr($cgy, $row['user']) ) :
					echo $row['url'] . @str_repeat(" ", 50 - strlen($row['url']) ) .  ' : Aktywowane' . "\n";
					
						$db->query("UPDATE fusion SET active = 1 WHERE id = ". $row['id']);
						
						if ( preg_match('@profile.php\?lookup=(\d+)@',$cgy, $uidee) ) :
								$db->query("UPDATE fusion SET profile = '". $row['url'] . 'profile.php?lookup=' . $uidee[1] ."' WHERE id = ". $row['id']); 
						endif;

						/* Dodawanie linka */
						
						$kra->post_vars = array(
							'user_name' => $row['user'],
							'user_email' => $ini['email'],
							'user_web' => $strony[array_rand($strony)],
							'update_profile' => 'Aktualizuj profil',
						);
						
						if ( !empty($hash[0]) ) :
								$kra->post_vars['user_hash'] = @$hash[0];
						endif;
						
						$kra->GetContent($row['url'] . 'edit_profile.php', true);
						$kra->GetContent($row['url'] . 'infusions/fusionboard4/usercp.php?section=details&status=updated', true);
						
						
						#file_put_contents('_TEST/' . rand(00,9999999) . '.html', $row['url'] . $cgy);
						
						#print_r($kra->post_vars);
						#die;

					
						else :
						
						#file_put_contents('_TEST/' . rand(00,9999999) . '.html', $row['url'] . $cgy);
						
					echo $row['url'] . @str_repeat(" ", 50 - strlen($row['url']) ) .  ' : Fail' . "\n";
					
			endif;
	
	
			#print_r($row);
			#die;
	
			
	}
	
	/* Koniec aktywowanie kont */


	
	
	
	
	function short_url2($url) {
		$ret = '<a href="http://">'.$url.'</a>';
	
		$ret = preg_replace("/<a href=(.*?)>(.*?)<\/a>/ie", "(strlen(\"\\2\") > 41 && !eregi(\"<\", \"\\2\") ) ? ''.substr(\"\\2\", 0, 48) . ' ... ' . substr(\"\\2\", -10).'' : ''.stripslashes(\"\\2\").''", $ret);
	
		return $ret;
	}
	
	
?>