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
			'W' =>  'G��pY��4E���',
			'D' =>  '��bR���O��T�', 
			'd' => '�����CZs��J��L%�',
			'A' => '��21eP',
			'a'=> '�5�d��aԒWOXJ',
			'0' => '§��cGYA�BӧGA',
			'P' => 'ɀ�B��T�ZTq�h�h�$�*K',
				'O' => '�Ό&��jX�<Յ�x���Q�ql,���2�', // o nie zero
			'o' => 'Ԫμ��u�}��j�',
			'Z' => 'L$�ٚ�rE!�',
			'i' => '��Y�v$I[���W��=.�m\'�',
			'I' => '�GJ�P�D��i��',
			'S' => 'V��BR�N�U�Fmv���',
			's' => 'Wu��8ͣ�',
			'U' => 'm�}k4�r��o$F',
			'u' => '�q���JSJ�>��YcCKiF�',
			'9' => '���Y#*����',
			'H' => 'h��t���#UP',
			'N' => '(:�th8�В#',
			'n' => '��<�x�2M�2',
			'T' => '�x޳?��������W�',
			'R' => '�Qzy�JJ�_��~�V|��;',
			'r' => '8�D�˖�����6����',
			'G' => 'ҮShY�A�SU',
			'C' => 'T��MJ$V�b�����b',
			'c' => '�b��oa���',
			'Y' => '�St����֙��q�V',
			'M' => 't�T�GT����',
			'B' => '�40ڪKc,IĖ���O�3�J����',
			'V' => '<�L9T-6�Z-)',
			'F' => '����sլ��v�',
			'4' => '8�5�W���U���',
			'5' => 'eb�g���(è',
			'E' => 'FR���U�1F',
			'J' => '��̺��>�2�f�',
			'K' => '��N�ԍ�RjAS�',
			'k' => 'ڳR�mZ��D',
				'L' => 'Wڞ�~Q~76��3',
			'l' => 'uK==���͵���',
			'3' => '�o����X�EB',
			'7' => '�bs��:.hԸt��z',
			'2' => '޵���A���x��Qg',
			'X' => 'YYc�I����',
			'8' => 'YZ��r˞eW�ߥ$�',
			'Q' => 'e�O��oo��',
			'6' => 'B��U2��*uX�+c�',
			'1' => 'gWۆ*LAME��',
			
		);


		$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
		foreach ( $co as $id => $val ) :
				$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
		endforeach;
		
		preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
		
		$slowo = implode("", $wynik[1]);
		
		$iftrzy = $slowo;
		
		/* Us�wa podw�jne --  do wy��czenia */
		$slowo = preg_replace('{(.)\1+}','$1', $slowo);
		
		
		/* WAV */
		
		$co = array(
			'W' => '�K�w�T�������~�M�L�',
			'D' => '�����B�*�x�u�n���G�6����"���', 
			'A' => '���q�l�p�5���-�r�D��',
			'0' => '���e���j�3�����',
			'P' => '��u���s�^��d�l���',
				'O' => '���M����4�C�]�:�', // o nie zero
			'Z' => '�n�����C�a�q��',
			'I' => 'z�������(�������',
			'S' => '����������',
			'U' => '����������o�����',
			'9' => '�o���������(����������2�',
			'H' => '����$�0�=���I�����',
			'N' => '�h���`���^ߞ',
			'T' => '����������e�',
			'R' => '��������&��g�',
			'G' => '�s�4�q�-�;���W�q�',
			'C' => '��5���=�����I�����V���,',
			'Y' => '�K�6�P���������&�',
			'M' => '��1����"�)�z��V�&�f�',
			'B' => '����l���h���b�&�',
			'V' => '�������f�u�������R�',
			'F' => '����a�8���',
			'4' => '�����;��W�8������',
			'5' => '��2�E�R�����p�j�8�e�����',
			'E' => '���$���T�����v�',
			'J' => '�����*���q�}�:���5��%',
			'K' => '�����(��}��������',
				'L' => '�v��%�p��s���B���',
			'3' => '�����������w��E�',
			'7' => '���{�5�Z�G�\�',
			'2' => 'f�����d�����',
			'X' => '�q���������N��j�����z�',
			'8' => '��������9�6�����$�����x���',
			'Q' => '�D�d�x�*�����N�',
			'6' => '�F�������������#�',
			'1' => '�y�u���i���I�',
			
		);
		

		if ( empty($slowo) ) :

				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Us�wa podw�jne --  do wy��czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		
		/* ESPANOL */
		
		$co = array(
			'W' => '���i���P����������',
			'D' => '�ģ����Y�C�M���^�i', 
			'A' => '�v�t��������}������H',
			'0' => '��ޯۇ؎���������ƾî�����',
			'P' => '�7���������*�{�������������',
			'O' => '���U�����U�������o�����v�', // o nie zero
			'Z' => '����������~�i�W�S�e�����<���',
			'I' => '����7��&��.���x�',
			'S' => '����������#�/��',
			'U' => 'g���������������',
			'9' => '�w�������3�_�r�D�������u�',
			'H' => '���A�i�v�y�p�l�|�����',
			'N' => '�p�����o�������t�',
			'T' => '�?�����p�����+',
			'R' => '�����7�����v�Q�',
			'G' => '�����^���D�V���N�9���',
			'C' => '��G�M�����Q�I��=���',
			'Y' => '�����,�v�c���J�X�)���',
			'M' => 'Ҽ�s��ѳҧ�8��Ӻҿ�c�L��ʎ�',
			'B' => '���8�9���ܭ����Ӆ���5����x�9',
			'V' => '�������������1�',
			'F' => '��Z��������',
			'4' => 'cZe�f�f�e�cI`�\,Y',
			'5' => '������s�e�����������',
			'E' => '����,�����h�V�~�����0',
			'J' => '���X�4��T����]���W���G���D���R',
			'K' => 'ܨڇ�W�H�7�����x�Z�+���',
			'L' => '3k4�6Z8.9s8A6�2?/�+�',
			'3' => '�����u�����}����',
			'7' => '��O���K�������%����8�x�',
			'2' => '.�r�a���3�?�K���3',
			'X' => '�Q�W�I���#���p����',
			'8' => '���6�����������',
			'Q' => '�c���F�����������',
			'6' => '�����A���T���i���&�B�',
			'1' => '�3�F�6���QЊх�g�+��', 
			
		);
		

		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Us�wa podw�jne --  do wy��czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		/* ESPANOL leydie */
		
		$co = array(
			'W' => '�������(�B�q���',
			'D' => '����������_�x�x���', 
			'A' => '������-�C����',
			'0' => '�p���U�N�2�z�',
			'P' => '������S�����W���',
			'O' => '�1�B�@�z�P������W�', // o nie zero
			'Z' => '���m�B�m�u�H�',
			'I' => '�G���F�3�m�q�',
			'S' => '�������������S�������!',
			'U' => 'K�s�����<�,��t���',
			'9' => '����w�����z�s���5�',
			'H' => '����������r�',
			'N' => '��p���!�b�s��',
			'T' => 'D���+�����',
			'R' => '�:���������L�',
			'G' => '��8�X�z�@����������]',
			'C' => '����n�S�^�S���',
			'Y' => '���\�W�����',
			'M' => '�����������&�?�_�',
			'B' => '�8�0�U�����',
			'V' => '�v�3��2�*�}���{�',
			'F' => '���������',
			'4' => '��B���4�N�������',
			'5' => '�,�C�����Y���',
			'E' => '��������Q�[���0�',
			'J' => '�j�O��k�������n',
			'K' => '��q������1�;����',
			'L' => '���$�a��',
			'3' => '���������h������',
			'7' => '�M���c�������',
			'2' => '��������W�����',
			'X' => '��V��!�����',
			'8' => '�������v���',
			'Q' => '������v������������',
			'6' => '����������G�J�L�C�',
			'1' => 'x�����n�;�$���6���',
			
		);
		
		
		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Us�wa podw�jne --  do wy��czenia */
				$iftrzy = $slowo;
				$slowo = preg_replace('{(.)\1+}','$1', $slowo);

		endif;
		
		/* Polski */
		
		$co = array(
			'W' => '��������������',
			'D' => '����������������������������������������', 
			'A' => '{{{zzzzzzyyxxwwxxyyz{{||||{{{{|}',
			'0' => '|{zyxxwwxyy{|}',
			'P' => '��xsponoprstuvvutsrp',
			'O' => '|{zyxwwwxyz{|}~', // o nie zero
			'Z' => '�����������������������',
			'I' => '�������',
			'S' => '�{ung`ZVSRSUY_ekpvz~��',
			'U' => '�����������������',
			'9' => '{{zyyxxxyyyyzz{{|}}}}}',
			'H' => '�����������������',
			'N' => 'kZK@;=ERbs������wo',
			'T' => '������������',
			'R' => '������������',
			'G' => 'yx{���������',
			'C' => '�����������',
			'Y' => '����������������',
			'M' => 'z{{zzz{}���',
			'B' => '����������',
			'V' => 'cfiloqtvxy{|}~',
			'F' => '[\`ekt}����',
			'4' => 'sttuvxyzzz{zzzzzz',
			'5' => '�����������������',
			'E' => '��������',
			'J' => '�{vqligfgikmoqsuvxz{{zzyxxy{~',
			'K' => '}zxvtsrrrstvwyz|}',
			'L' => '||{zyxwwwwxyzzzzzyyyyyyxxxxxxxyyz||}',
			'3' => '}}}}}}}}||||||||||}}}~~~~~}}',
			'7' => '�������������������������������',
			'2' => '~}}|{{{{zzzyxwvuuuuuuvvwyz|~�',
			'X' => '}{zywwwxyz|~',
			'8' => 'zz{{{{{{{{zzyxxwwwwxxyz{{{',
			'Q' => '{vrmifca`__^^]]\[Z',
			'6' => '~|zxvtrpnkifdccdfimqv{���',
			'1' => '{{{{{{{zzzyyyxxxxyz{{|}',
			
		);
		
		
		if ( empty($slowo) ) :


				$file = preg_replace('#fopen\(\./audio/([A-Z0-9a-z\.])\.mp3#','!!!!!!!!\\1@@@@@@',$file);
				foreach ( $co as $id => $val ) :
						$file =  str_replace($val,'!!!!!!!!' . strtoupper($id) . '@@@@@@', $file);
				endforeach;
				
				preg_match_all('#!!!!!!!!([A-Za-z0-9\.])@@@@@@#', $file, $wynik);
				
				$slowo = implode("", $wynik[1]);

				
				/* Us�wa podw�jne --  do wy��czenia */
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