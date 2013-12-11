
     '######::'########:::::'###::::'##:::'##::::'###::::'##::: ##:'########::
    '##... ##: ##.... ##:::'## ##::: ##::'##::::'## ##::: ###:: ##: ##.... ##:
     ##:::..:: ##:::: ##::'##:. ##:: ##:'##::::'##:. ##:: ####: ##: ##:::: ##:
     ##::::::: ########::'##:::. ##: #####::::'##:::. ##: ## ## ##: ##:::: ##:
     ##::::::: ##.. ##::: #########: ##. ##::: #########: ##. ####: ##:::: ##:
     ##::: ##: ##::. ##:: ##.... ##: ##:. ##:: ##.... ##: ##:. ###: ##:::: ##:
    . ######:: ##:::. ##: ##:::: ##: ##::. ##: ##:::: ##: ##::. ##: ########::
    :......:::..:::::..::..:::::..::..::::..::..:::::..::..::::..::........:::

<?PHP

#@error_reporting(0);
#@set_time_limit(0); 


$dbe = new SQLite3('cfg/main.db');

$qe = $dbe->query("SELECT user,pass,url,profile FROM fusion WHERE active = 1");


$cachee = array();

$cachee[] = array('user','pass','url','profile');

while ($row = $qe->fetchArray(SQLITE3_ASSOC)) {

	$cachee[] = $row;

}


file_put_contents('export.csv', array_to_scv($cachee,false) );

sleep(3);


function array_to_scv($array, $header_row = true, $col_sep = ",", $row_sep = "\r\n", $qut = '"')
{
	if (!is_array($array) or !is_array($array[0])) return false;
	
	$output = '';
	
	//Header row.
	if ($header_row)
	{
		foreach ($array[0] as $key => $val)
		{
			//Escaping quotes.
			$key = str_replace($qut, "$qut$qut", $key);
			$output .= "$col_sep$qut$key$qut";
		}
		$output = substr($output, 1)."\n";
	}
	//Data rows.
	foreach ($array as $key => $val)
	{
		$tmp = '';
		foreach ($val as $cell_key => $cell_val)
		{
			//Escaping quotes.
			$cell_val = str_replace($qut, "$qut$qut", $cell_val);
			$tmp .= "$col_sep$qut$cell_val$qut";
		}
		$output .= substr($tmp, 1).$row_sep;
	}
	
	return $output;
}


?>