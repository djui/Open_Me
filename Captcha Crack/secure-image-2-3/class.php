<?PHP

class crakand {

	var $ua = "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3 (FM Scene 4.6.1)";
	var $curl_header = 0;

	function __construct() {
	
		$user = array(
			1 => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3 (FM Scene 4.6.1)',
			2 => 'Mozilla/5.0 (Windows NT 5.1; rv:11.0) Gecko/20100101 Firefox/11.0',
			4 => 'Opera/9.80 (Windows NT 5.1; U; Distribution 00; pl) Presto/2.10.229 Version/11.60',
			5 => 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.65 Safari/535.11'

	   );
	   
	   $this->ua =  $user[array_rand($user)];
	
	}


	function GetContent($path_url, $typ = false) {
		
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $path_url);
		curl_setopt($init, CURLOPT_TIMEOUT, 12);
		curl_setopt($init, CURLOPT_CONNECTTIMEOUT, 8);
		
		if ($typ == true) {
			curl_setopt($init, CURLOPT_POST , 1);
			curl_setopt($init, CURLOPT_POSTFIELDS, @$this->post_vars);
		}else {
	       curl_setopt($init, CURLOPT_POST , 0);
		}
	   
	   #$interface =  $interface[array_rand($interface)];

		curl_setopt($init, CURLOPT_HTTPHEADER, array('Expect:') );	
		curl_setopt($init, CURLOPT_USERAGENT, $this->ua);
		curl_setopt($init, CURLOPT_HEADER, $this->curl_header);

		curl_setopt($init, CURLOPT_FOLLOWLOCATION, 1);

		$sciech = str_replace("/",'\\\\',str_replace(basename($_SERVER['PHP_SELF']),'',$_SERVER['SCRIPT_FILENAME'] ));
		

		curl_setopt($init, CURLOPT_COOKIEJAR, $sciech . 'cookie.txt');
		curl_setopt($init, CURLOPT_COOKIEFILE, $sciech . 'cookie.txt');

		
		curl_setopt($init, CURLOPT_REFERER, $path_url);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
		$source = curl_exec ($init);

		$this->curl_info = curl_getinfo($init);

		
		$this->page_source = $source;
		curl_close($init);
		return $this->page_source;
	}
	
	
function voicetotext($file) {

		$slowo = '';

		$co = array(
			'W' =>  'GªÂpY‘Ç4EÉàœ',
			'D' =>  'ØöbRžáÒOÏÖTê', 
			'd' => 'ÐïÀìåCZsž¸J£ÅL%Å',
			'A' => 'îóœ21eP',
			'a'=> '¦5ódªÔaÔ’WOXJ',
			'0' => 'Â§‘‡cGYAãBÓ§GA',
			'P' => 'É€òBŒÓTÀZTqýhÊhê$ù*K',
				'O' => 'ÞÎŒ&ŒåjX´<Õ…äx’ÒèQµql,ÐãÃ2ß', // o nie zero
			'o' => 'ÔªÎ¼ÂÐuÞ}áØj‡',
			'Z' => 'L$úÙšâ»rE!é',
			'i' => '‘ÉY¬v$I[£üâWŸÄ=.¥m\'¤',
			'I' => 'ÑGJPªD’˜iÂÜ',
			'S' => 'V¤ŸBRáNæ®U¶FmvÁ·Ž',
			's' => 'Wu÷‡8Í£ò',
			'U' => 'mÀ}k4ør‰»o$F',
			'u' => 'Ëqí´¼JSJØ>ÔæYcCKiF»',
			'9' => 'ÓíÏY#*ØßÚð',
			'H' => 'håÒtñ©òê#UP',
			'N' => '(:éth8½Ð’#',
			'n' => 'Âä<ùxÙ2M÷2',
			'T' => 'ëxÞ³?—îô¯¾âû×WÕ',
			'R' => 'ãQzyúJJŸ_»Ë~þV|ªÀ;',
			'r' => '8éDšË–™†Åíâ6¹ñõÏ',
			'G' => 'Ò®ShYøA‹SU',
			'C' => 'TÉúMJ$V‚b¯ãÚÖÚb',
			'c' => '¥b¹ŸoaœÂñ†',
			'Y' => '£StÌö‡Ö™÷ñq¼V',
			'M' => 'tºTìGTÍíÿó',
			'B' => 'þ40ÚªKc,IÄ–³•›O•3×JªŒ£',
			'V' => '<ïL9T-6¤Z-)',
			'F' => 'ëõúüsÕ¬î÷v¿',
			'4' => '8­5ôW‹¶‘Uå¬ÆÛ',
			'5' => 'ebàg“ãœÂ(Ã¨',
			'E' => 'FR¥°ûUŽ1F',
			'J' => 'úþÌº¾«>¥2Ôf§',
			'K' => 'þëN½Ô«RjASê',
			'k' => 'Ú³R×mZíÂD',
				'L' => 'WÚžü~Q~76ü»3',
			'l' => 'uK==§žÕÍµ­ãï',
			'3' => 'âoáþú„X×EB',
			'7' => 'œbsïã:.hÔ¸têï¡z',
			'2' => 'ÞµãA÷Ìùx§—Qg',
			'X' => 'YYc¡IçÎöÔ',
			'8' => 'YZìírËžeWšß¥$£',
			'Q' => 'eO¹çµoo­ã',
			'6' => 'B¦U2µŠ*uXò+cœ',
			'1' => 'gWÛ†*LAMEªª',
			
		);


		$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
		foreach ( $co as $id => $val ) :
				$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
		endforeach;
		
		preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
		
		$slowo = implode("", $wynik[1]);
		
		$iftrzy = $slowo;
		
		/* Usówa podwójne --  do wy³¹czenia */
		$slowo = preg_replace('{(.)\1+}','$1', $slowo);
		
		
		/* WAV */
		
		$co = array(
			'W' => 'þKýwýTýºû‹ú•ú~úMúLú',
			'D' => 'ü‘ùÞõBò*îxèuãnâÃãGà6Ýðã€ç"ãîè', 
			'A' => 'òœòóqñlñpò5óîõ-ørúDýá',
			'0' => 'þõûeú­újú3û¤ûÍù',
			'P' => 'Ð÷uö•ôsò^ð®ïdîlë³ê»ë',
				'O' => 'êñéMéãê€ì4ëCé]é:ì', // o nie zero
			'Z' => 'ônñìîßìCêaèqê¯í',
			'I' => 'zûÍûð÷àð(íÐéöåÊß',
			'S' => 'ø«òûðœóÁõ¯ô',
			'U' => 'ûªøôôÄò¾ðúìoê¬èýãªß',
			'9' => 'þoûÅ÷Âòøíüé(çÐåøåžæßäíá2Þ',
			'H' => 'ùþšþ$þ0ý=üýúIù¤ø—÷',
			'N' => 'ðhìÌæ`ãèâ^ßž',
			'T' => 'ÏþàýÃúÑõ³ôeò',
			'R' => '„ûÓõ«ò×ð&ñ¾ògò',
			'G' => 'úsú4úqø-÷;ö¶ôWóqñ',
			'C' => '‡ý5ûŽø=÷ÝôÑñIðóîáíVíÛë,',
			'Y' => 'þKý6üPû±úãùŸøßö&õ',
			'M' => 'ì‚ë1ê¤éòé"ê)ézæ¦ãVâ&ãfæ',
			'B' => 'Àý”ýlù•òhñýîbæ&ä',
			'V' => 'æÏéÊèâèfîuñûðÊöÝýRþ',
			'F' => '×ú¬õañ8ëÓä',
			'4' => 'óÞñÚñ;ñ°òWó8òµñüïÞí',
			'5' => 'Ýþ2ûEùRù¯öÊõpôjî8èeãôàöã',
			'E' => 'ýÖû$ûšùT÷­õØôvô',
			'J' => 'þ“ûïø*öæôqò}î:ïéð5îžê%',
			'K' => 'þú¯õ(ò¤ð}ïÑíÇëŒêðê',
				'L' => 'ìví¿í%ípí«ìsêÅèBî”ùä',
			'3' => 'õðñâðÔòÐð†îwïœïEï',
			'7' => 'ù‰ø{÷5öZõGô\ñ',
			'2' => 'fýøüÏûdûÓþýþ',
			'X' => 'þqüþùüøŽúÜùNó¾êjèàìÐîzè',
			'8' => 'þðü›üéú9ù6ø×÷Ãö$ô¦óöóxóÙñ',
			'Q' => 'üDúd÷xô*òîïÏìNé',
			'6' => 'ûFùýöÌöþ÷±÷èõµõ#÷',
			'1' => 'õyôuóìðiíÐìIì',
			
		);
		

		if ( empty($slowo) ) :

				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Usówa podwójne --  do wy³¹czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		
		/* ESPANOL */
		
		$co = array(
			'W' => 'õ÷ôiôÒóPóöòµòò¬òÁòäò',
			'D' => '§Ä£õŸœYšCšMœýŸ^¤i', 
			'A' => 'èvétêœëÂìÝíÕî}ïÚïðï²ïH',
			'0' => 'âÕÞ¯Û‡ØŽÕÇÒäÏùÌÊìÆ¾Ã®À¤½ïºØ',
			'P' => 'õ7óåðøîàíìí*ï{ñŽôÝ÷Ïúãü§ýîüÔ',
			'O' => 'ïÞîUîûíøíUîþîÝïÁðoñÏñÐñvñ', // o nie zero
			'Z' => 'ªú¯ú¬ú¤ú“ú~úiúWúSúeú‘úÙú<û­û',
			'I' => 'Ñìßë7ë¤ê&ê³é.éÁèxè',
			'S' => 'ì¢æÀâÕàŸàÓá#ä/ç±ê',
			'U' => 'gøÊøõøêøËø¯ø¢øÂø',
			'9' => 'èwéþêÔì÷î3ñ_órõD÷¼øíùÑúuû',
			'H' => 'óõóAôiôvôyôpôlô|ôŸôÕô',
			'N' => 'öpöãö¦÷oøíø»øÍ÷tö',
			'T' => 'û?ûçû¶üpýàýÈý+',
			'R' => 'ûÝúßú7ûÖûžüvýQþ',
			'G' => 'êÛíÖñ^õð÷DùVù„øN÷9öÅõ',
			'C' => '«çGçMçÈçÈèQêIì¡î=ñðó',
			'Y' => 'úÄûŸü,ývýcýöüJüXû)úåø',
			'M' => 'Ò¼ÑsÑÜÑ³Ò§Ó8ÔîÓºÒ¿ÐcÎLÌòÊŽÊ',
			'B' => 'ááà8à9ßÜÝÜ­ÙìÖåÓ…ÐôÌ5ÉÅÀÀx¼9',
			'V' => '†›†Â‹À–¦§¶¼éÒÝæ1õ',
			'F' => '«êZë½ë£ëüêµéøç',
			'4' => 'cZeÁfôfáe€cI`¾\,Y',
			'5' => 'ÛúÇùïøsøeøÌø”ùœú·û¯ü',
			'E' => 'àýïû,úÇøÛ÷h÷V÷~÷¥÷—÷0',
			'J' => 'óåñXð4ï‡îTî€îàî]ïáïWðÌðGñÁñDòÎòR',
			'K' => 'Ü¨Ú‡ÙWÙHÚ7ÜÓÞÆáxäZæ+ç—æ’ä',
			'L' => '3k4‚6Z8.9s8A6þ2?/º+ó',
			'3' => 'úãúîùu÷ÒóÕï}ì×ê¼ë',
			'7' => 'ÝõOõÄôKô÷óØóêó%ô€ôâô8õxõ',
			'2' => '.ûrøaöŽõ3ö?øKûÎþ3',
			'X' => 'ëQíWïIñöò#ôžôpô´óšò',
			'8' => 'öïæ6ÛäÔåÔûÚäåŸóá',
			'Q' => 'åcãÍáFà•ÞÅÜâÚÜØäÖ',
			'6' => 'úÞùéùAúÁúTûçûiüØü&ýBý',
			'1' => 'Ç3ÉFË6ÍÝÎQÐŠÑ…ÒgÓ+Ôß', 
			
		);
		

		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Usówa podwójne --  do wy³¹czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		/* ESPANOL leydie */
		
		$co = array(
			'W' => 'ðŸðèñÙñŠð(ñBðqïÚð',
			'D' => 'ùØìÃé¶ëÑîÕî_êxçxèòè', 
			'A' => 'ÑôÇóÊò-óCóßò…ó',
			'0' => 'ùp÷ÌôUóNò2ñzð',
			'P' => 'òªòüñäðSðµð–ñâñWñøñ',
			'O' => 'û1ûBø@ôzñPðêï›ðÈòWö', // o nie zero
			'Z' => 'óÍômöBõmöuùHü',
			'I' => 'õGõµóFô3ómñqñ',
			'S' => 'öàö£øÑø©ø­ùíøSøèù³øïø!',
			'U' => 'Kósðñíäë<ê,é–ètèÂè',
			'9' => 'å³äõãwãÅãÀãzåsçÞç5í',
			'H' => 'åù‡ôàóñéÎðr÷',
			'N' => 'õõpôðò!ñbïsí†ë',
			'T' => 'DýÈü+ýÉýÙý',
			'R' => '÷:÷Çõžôáô‘ôLõ',
			'G' => 'Çü8úXúzû@ùºõØóõñ‰ñ‚ñ³ô]',
			'C' => 'ìšëŒëžênëSï^êSéêô',
			'Y' => 'ú¤ú\úWùîø“ø',
			'M' => 'ý¹ûÂúµù‹ø¶÷&ö?õ_ô',
			'B' => 'û8ú0ùUøŽ÷²ö',
			'V' => 'évè3è‚è2é*ê}ëçì{î',
			'F' => 'ôÏô†óõùô«ò',
			'4' => 'ÛýBýÓü4üNûŒù¬ø½ø',
			'5' => 'é,èCæöäÛäYäËä',
			'E' => 'ØõÍóÁõôöQö[ö÷0÷',
			'J' => 'êjêOëŒíkïâóæùµûn',
			'K' => 'ýõqó¤ðñîèð1ò;òÃõÍ',
			'L' => 'óßò$òaññ',
			'3' => 'ü«ûõûñü×ühúÕù—úÞ',
			'7' => 'øMñÖìcïÚõúøÚø',
			'2' => 'Úþäþ¯þžüWûãùµ÷',
			'X' => 'ÖìVê°é!é©ä°â÷è',
			'8' => 'õèôþôùôvôøó',
			'Q' => 'õŽòÐïívëðéÓèÐç”çëæÍæ',
			'6' => 'õ„ô‰õÕöÁ÷ü÷GøJøLúCü',
			'1' => 'xþôüÏùnö;ô$ñïí6ììé',
			
		);
		
		
		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Usówa podwójne --  do wy³¹czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		/* Polski */
		
		$co = array(
			'W' => '‘’““”••••••”“‘',
			'D' => '†††††††††††‡‡‡‡†††††††††††††††††………„„„„„', 
			'A' => '{{{zzzzzzyyxxwwxxyyz{{||||{{{{|}',
			'0' => '|{zyxxwwxyy{|}',
			'P' => '‰€xsponoprstuvvutsrp',
			'O' => '|{zyxwwwxyz{|}~', // o nie zero
			'Z' => '‹‹‹‹ŒŒŽŽŽŽŽŽŒŒŒ‹‹Š',
			'I' => '…‰Ž’•—•',
			'S' => '€{ung`ZVSRSUY_ekpvz~‚†',
			'U' => '‡‰ŠŒŽŽŽŽŽ',
			'9' => '{{zyyxxxyyyyzz{{|}}}}}',
			'H' => '‘’’“““““’‘ŽŒŠ‰‡',
			'N' => 'kZK@;=ERbs€‰Œ‡€wo',
			'T' => 'Œ›«ºÆÐØÜÜÙÒÆ',
			'R' => 'ŠŠ‹ŒŒŒŒ‹Šˆ‡†',
			'G' => 'yx{€‡˜Ÿ£¥¥£',
			'C' => 'ŽŒŒ‹ŠŠ‰‰',
			'Y' => '‹‹ŒŒŽŽŽ',
			'M' => 'z{{zzz{}†Œ',
			'B' => '¥§©ªª¨¥¡—',
			'V' => 'cfiloqtvxy{|}~',
			'F' => '[\`ekt}‡’œ¤',
			'4' => 'sttuvxyzzz{zzzzzz',
			'5' => 'Š‹ŒŒŒ‹‹‹‹‹ŒŒŒ‹Š',
			'E' => '›ŸŸžœ™”',
			'J' => '€{vqligfgikmoqsuvxz{{zzyxxy{~',
			'K' => '}zxvtsrrrstvwyz|}',
			'L' => '||{zyxwwwwxyzzzzzyyyyyyxxxxxxxyyz||}',
			'3' => '}}}}}}}}||||||||||}}}~~~~~}}',
			'7' => '‰‰‰‰‰‰ŠŠŠŠŠŠŠ‹‹‹‹‹‹‹‹ŒŒŒŒŒŒ‹‹‹Š',
			'2' => '~}}|{{{{zzzyxwvuuuuuuvvwyz|~€',
			'X' => '}{zywwwxyz|~',
			'8' => 'zz{{{{{{{{zzyxxwwwwxxyz{{{',
			'Q' => '{vrmifca`__^^]]\[Z',
			'6' => '~|zxvtrpnkifdccdfimqv{€„‡',
			'1' => '{{{{{{{zzzyyyxxxxyz{{|}',
			
		);
		
		
		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Usówa podwójne --  do wy³¹czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;

		
		
		
		
		/* END */
		
		if ( strlen($slowo) == 3 ) {
		
				return $iftrzy;
		}

		return $slowo;
}		


	
	
}// end class




		$co = array(
			'W' => '',
			'D' => '', 
			'A' => '',
			'0' => '',
			'P' => '',
			'O' => '', // o nie zero
			'Z' => '',
			'I' => '',
			'S' => '',
			'U' => '',
			'9' => '',
			'H' => '',
			'N' => '',
			'T' => '',
			'R' => '',
			'G' => '',
			'C' => '',
			'Y' => '',
			'M' => '',
			'B' => '',
			'V' => '',
			'F' => '',
			'4' => '',
			'5' => '',
			'E' => '',
			'J' => '',
			'K' => '',
			'L' => '',
			'3' => '',
			'7' => '',
			'2' => '',
			'X' => '',
			'8' => '',
			'Q' => '',
			'6' => '',
			'1' => '',
			
		);


?>