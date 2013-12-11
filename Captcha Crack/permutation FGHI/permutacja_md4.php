<? 
/* WHEn sombody use cookie to store captcha code in cookie as sha1

AAAF - 970b502393c526e08eae93e39b174ee49e0b8925

*/


$Array=permutations("ABCDEFGHIJKLMNOPRSTUWYVXZ1234567890",4); 
for($i=0 ; $i < count($Array) ; $i++) { 
        echo "$i." . $Array[$i] . "\n";
		@mysql_query("INSERT into crack.sha VALUES('". $Array[$i] ."','". sha1($Array[$i]) ."');"); 
} 



function permutations($letters,$num){ 
    $last = str_repeat($letters{0},$num); 
    $result = array(); 
    while($last != str_repeat(lastchar($letters),$num)){ 
        $result[] = $last; 
        $last = char_add($letters,$last,$num-1); 
    } 
    $result[] = $last; 
    return $result; 
} 
function char_add($digits,$string,$char){ 
    if($string{$char} <> lastchar($digits)){ 
        $string{$char} = $digits{strpos($digits,$string{$char})+1}; 
        return $string; 
    }else{ 
        $string = changeall($string,$digits{0},$char); 
        return char_add($digits,$string,$char-1); 
    } 
} 
function lastchar($string){ 
    return $string{strlen($string)-1}; 
} 
function changeall($string,$char,$start = 0,$end = 0){ 
    if($end == 0) $end = strlen($string)-1; 
    for($i=$start;$i<=$end;$i++){ 
        $string{$i} = $char; 
    } 
    return $string; 
} 

?>


