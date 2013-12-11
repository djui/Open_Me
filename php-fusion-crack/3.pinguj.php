<?PHP


	@set_time_limit(0); 
	error_reporting(0);
	$db = new SQLite3('cfg/main.db');
	include('class.php');
	
	$kra = new crakand;


	$q = $db->query("SELECT * FROM fusion WHERE active = 1 AND ( last_login < datetime('now', '-8 minutes') OR last_login IS NULL )  ORDER BY RANDOM() ");
	
	
	echo "\n" . ' Nie nalezy uruchamiac pingowania gdy inne ' .  "\n" .' skrypty  [ tworzenie kont,aktywacja ] dzialaja w tle !!! ' . "\n\n";

	$has = false;
	
	file_put_contents('cfg/cookie.txt','');

	while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
		$has = true;

		$kra->post_vars = array('user_name' => $row['user'], 'user_pass' =>  $row['pass'] , 'remember_me' => 'y',  'login' => 'Zaloguj' );
		
		$kra->curl_header = 1;
		
		$contenet = $kra->GetContent($row['url'] . 'news.php', true);
		
		#$kra->GetContent($row['url'] . 'index.php' , false);
		

		echo  $kra->curl_info['connect_time'] .  @str_repeat(" ", 5 - strlen($kra->curl_info['connect_time']) ) .   '   :   ' . $row['url'] ;
		echo @str_repeat(" ", 50 - strlen($row['url']) );
		
		$cgy= $kra->GetContent($row['url'] . 'edit_profile.php');
		
		if ( strstr($cgy, $row['user']) ) :
				echo 'OK ';
		endif;
		
		#file_put_contents('d.txt', $contenet);
		
		echo  "\n";
		#die;
		

		@$db->query("UPDATE fusion SET last_login = DATETIME('NOW') WHERE id = ". $row['id']);

	}
	
	if ( $has == false ) {
			echo "   \n\n   Brak stron w bazie lub zostaly one juz spingowane w przeciagu 8 minut\n\n\n\n";
	}
	
	echo "\nEND:";

	sleep(10);
	

?>