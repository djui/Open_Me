    
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
   
	   
<?PHP

	@set_time_limit(0); 
	include('class.php');


	$kra = new crakand;
	
	/* 
	
		!Important
	
		For secure image 3 need make new fingerprint from audio FILEs its use MP3 not wav :)
		
		Include some language fingerprint: pl,it,en
	
	*/
	
	
	
	$cound = file_get_contents('securimage_audio.mp3');
	
	
	$txt = $kra->voicetotext($cound);
	
	file_put_contents('cap.txt', $txt);

	
	echo 'Cap:' . $txt;
	
	sleep(123);
	

		/* New one add sound noise :P 
		$chk = $kra->GetContent('http://www.phpcaptcha.org/try-securimage/');
		
		

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
				#echo 'Else: ' .$val ."\r\n";
				#continue;
				$cound = '';
		}
		*/
	
		
		
?>		
		
		