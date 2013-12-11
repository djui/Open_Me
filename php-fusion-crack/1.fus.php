    
                 .   _     .                     
              .     (_)         o                
       o      ____            _       o          
      _   ,-/   /)))  .   o  (_)   .             
     (_)  \_\  ( e(     O             _          
     o       \/' _/   ,_ ,  o   o    (_)         
      . O    _/ (_   / _/      .  ,        o     
         o8o/    \\_/ / ,-.  ,oO8/( -TT          
        o8o8O | } }  / /   \Oo8OOo8Oo||     O    
       Oo(""o8"""""""""""""""8oo""""""")         
      _   `\`'                  `'   /'   o      
     (_)    \                       /    _   .   
          O  \           _         /    (_)      
    o   .     `-. .----<(o)_--. .-'              
       --------(_/------(_<_/--\_)--------hjw 
    

							TRWA AUTORYZACJA SESJI                 

						

<?PHP
#asds
/// capimetaj o dodaniu class fo sourca

	@set_time_limit(0); 
	#error_reporting(0);
	#sleep(3);

	#echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

	$db = new SQLite3('cfg/main.db');
	include('class.php');
	$kra = new crakand;
	
	file_put_contents('cfg/cookie.txt','');

	$ini = parse_ini_file("cfg/cfg.ini");
	

	
	
	if ( strlen($ini['email']) < 5 ) {
			//Brak adresu e-mail w pliku: cfg/cfg.ini  ->  uzytkownik=????
			echo u('QnJhayBhZHJlc3UgZS1tYWlsIHcgcGxpa3U6IGNmZy9jZmcuaW5pICAtPiAgdXp5dGtvd25paz0/Pz8/');
			sleep(10);
			die;
	}
	
	#[Google Mail]/Spam
	
	
	if ( $ini['dziala'] == 'N' ) {


		if ( @!imap_open("{". $ini['smtp']  ."}INBOX", "". $ini['email'] ."", "". $ini['haslo'] ."")  ) :
		
				///'      Program nie mogl polaczyc sie serwerem pocztowym. Sprawdz konfiguracje ponownie'
				echo u('ICAgICAgUHJvZ3JhbSBuaWUgbW9nbCBwb2xhY3p5YyBzaWUgc2Vyd2VyZW0gcG9jenRvd3ltLiBTcHJhd2R6IGtvbmZpZ3VyYWNqZSBwb25vd25pZQ==') . "\n\n\n\n\n";
				
				else :
						$a = file_get_contents('cfg/cfg.ini');
						$a = str_replace('dziala=N','dziala=Y',$a);
						file_put_contents('cfg/cfg.ini',$a);
		endif; 


	}

	@$db->query("CREATE TABLE fusion(id INTEGER  NOT NULL PRIMARY KEY, user VARCHAR(20) NULL, pass CHAR(20) NULL, 
									url CHAR(300)  UNIQUE NULL,profile CHAR(500) NULL,
									active BOOLEAN DEFAULT 0 NULL,cached BOOLEAN DEFAULT 0 NULL,last_login TIMESTAMP  NULL);");
							
	@$db->query("CREATE INDEX indexik ON fusion (url  DESC,active  DESC,cached DESC,user DESC )");	

	@$db->query('VACUUM');



	/* Pobieranie z pliku */
	
	$f = fopen('cfg/scrap.txt',"r");
	$res = array();

	while ($k = fgets($f)){
		
		$k = preg_replace("/[\t|\n|\r]/", ""  , $k);
		if ( empty($k) ) continue;
		$res[] = $k;
			
	}

	/* END pobieranie z pliku */
	
	/* PObieranie z bazy */
	
	$dodane = array();
	

	
	//SELECT url FROM fusion
	$q = $db->query(  u("U0VMRUNUIHVybCBGUk9NIGZ1c2lvbg==") );
		
	while ( $row = $q->fetchArray(SQLITE3_ASSOC) ) :
	
			$dodane[] = $row['url']; 
		
	endwhile;
	
	/* END pobieranie z bazy */

	
	#jezeli http://www.php-fusion.co.uk/ the : Mnije wiesz lepiej spisz: pominiêto


	$p = array_unique( array_diff_key($res , $dodane ));
	
	//Do dodania: 
	

	echo  u('RG8gZG9kYW5pYTo=') . count($p) . "\n\n";
	
	shuffle($p);
	

	/* Pobieranie linkow */
	
	$f3 = fopen('linkuj.txt',"r");
	$strony = array();

	while ($k3 = fgets($f3)){
		
		$k3 = preg_replace("/[\t|\n|\r]/", "", $k3);
		if ( empty($k3) ) continue;
		$strony[] = $k3;
			
	}

	/* END pobieranie linkow */
	

	/* Pobranie nazwy uzytkownika */
	
	$f4 = fopen('cfg/users.txt',"r");
	$users = array();

	while ($k4 = fgets($f4)){
		
		$k4 = preg_replace("/[\t|\n|\r]/", "", $k4);
		if ( empty($k4) ) continue;
		$users[] = $k4;
			
	}
	
	/* END pobranie nazwy uzytkownika */
	
	
	/* Tworzenie kont */
	
	$i = 0;

	
	foreach ( $p as $val ) {
	
		#$val = 'http://naruto24.pl/';

		$reg = $val . 'register.php';
		
		$sound = $val . 'includes/securimage/securimage_play.php';

		
		$chk = $kra->GetContent($reg);
		
		unset($cound);
		unset($cap);
		
		#http://www.stangfiske.com/register.php
		#vimage
		
		#includes/captcha_include.php?captcha_code=c7c93d42fd1596c240b084e3f83a8f64
		#http://rusvoin.msk.ru/register.php

		#/*
		if ( strstr($chk ,'securimage' ) or  strstr($chk ,'securimage') or strstr($chk , 'securimage_play.php') ) {
		
				$cound = $kra->GetContent($sound);

				if ( $kra->curl_info['http_code'] == 404 or strstr($cound,'<head>') ) :
						$sound = $val . 'includes/captchas/securimage2/securimage_play.php';
						$cound = $kra->GetContent($sound);
				endif;
				
		} elseif ( strstr($chk ,'recaptcha' ) ) {
				#echo 'Recaptcha: ' .$val ."\r\n";
				continue;
		} else {
				#echo 'Cos innego: ' .$val ."\r\n";
				#file_put_contents('error.txt',$val ."\n", FILE_APPEND);
				#continue;
				$cound = '';
		}
		#*/
	
		#$cound = file_get_contents('asd.mp3');

		$cap =  $kra->voicetotext($cound);
		
		#file_put_contents('asd.mp3', $cound);
		
	
		if ( empty($cap) ) {
				#echo 'Nie rozpoznano: ' .$val ."\n";
				#file_put_contents('sec_no.txt',$val . "\r\n", FILE_APPEND);
				#continue; //  tymczaosow
				$cap = '';
		}
		
		$haslo = $kra->createRandomPassword();
		

		$uzytkownik = $users[ array_rand($users) ];;

		$yer = rand(80,95);
		
		$kra->post_vars = array(
			'username' => $uzytkownik,
			'password1' => $haslo,
			'password2' => $haslo,
			'email' => $ini['email'],
			'user_hide_email' => 1,
			'captcha_code' => @$cap,
			'user_web' =>  $strony[array_rand($strony)],
			'user_gg' => '',
			'user_aim' => '',
			'user_icq' => '',
			'user_msn' => '',
			'user_yahoo'  => '',
			'user_skype' => '',
			'user_tlen' =>  '',
			'user_location' => '',
			'user_day' => rand(2,29),
			'user_month' => rand(1,11),
			'user_year' => 19 . $yer,
			'user_sex' => 0,
			'user_sig' => '',
			'user_offset' => '0.0',
			'user_theme' => 'Default',
			'register' => 'Zarejestruj'
		);
	
		$kra->curl_header = 1;
		
		
		$rezultat = $kra->GetContent( $val . 'register.php', true);
		
		#file_put_contents('_TEST/' . rand(00,9999999) . '.html', $val . $rezultat);
		
		$i++;

		@$db->query("INSERT INTO fusion (id,user, pass,url,profile,active,cached) 
				VALUES (NULL,'". $uzytkownik ."', '". $haslo ."','". $val ."','',0,0)  ");
		
		echo $i . ' : ' .$val  . @str_repeat(" ", 50 - strlen($val) ) . '  Captcha: ' . $cap . "\n";
	}


	#sleep(33);


?>
