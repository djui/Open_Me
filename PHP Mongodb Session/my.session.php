<?PHP

class Session {

	var $session_lifetime = 3600;
	var $coll = 'Session';
	var $database = 'mongo_sess';
	
	function Session() 	{
			
		session_set_save_handler (array(&$this, '_open'),
				array(&$this, '_close'), array(&$this, '_read'),
				array(&$this, '_write'), array(&$this, '_destroy'),
				array(&$this, '_gc'));

		try	 {
			    $this->connection = new Mongo('mongodb://127.0.0.1', array("replicaSet" => false, "persist" => 'pra' ) );
				
				$this->_mongo = $this->connection->selectCollection( $this->coll, $this->database );
				
				/* FOR wincahe create index one time */
				
				if ( !wincache_ucache_exists('mngo_sess_')) :
						$this->_mongo->ensureIndex(array('_id' => true),array('background' => true, 'unique' => true ));
						$this->_mongo->ensureIndex(array('expire' => true),array('background' => true) );
						//$this->_mongo->ensureIndex(array('expire' => true),array('expireAfterSeconds' => $this->session_lifetime ) );

						wincache_ucache_set('mngo_sess_', 52);

				endif;
				
				/* END wincahce */

				
		} catch(MongoConnectionException $e)	{

				error_log('No conection to Mongo');
				header('HTTP/1.1 503 Service Temporarily Unavailable'); // mean server offline for Google 
				header('Status: 503 Service Temporarily Unavailable');
				header('Retry-After: 120'); // delay is 2 minutes
			 	die;
		}

		
	}

	function _open($session_savepath, $session_name) {	return true; }
	function _close() {	$this->_gc($this->session_lifetime); return true; }
	
	
	function _read($id)
	{
			
		/* Pobieranie z wincache */
		if ( wincache_ucache_exists('SES:' . $id )) :
					$sess = wincache_ucache_get('SES:' . $id); 
				else :
					$sess = $this->_mongo->findOne(array('_id' => $id), array('d' => 1,'_id' => 0 ) );
		endif;

		
		if (!isset($sess['d'])) {
            return false;
        } else {
            return $sess['d'];
        }

	}
	
	function _write($id, $data) 
	{

	    $doc = array(
            '_id'       => $id,
            'd'         => (string) $data,
			//'expire'   => new MongoDate()
            'expire'    => time() + intval($this->session_lifetime)
        );
        $options = array("upsert" => true);

		
		/* Zapisuje sessje do wincache */
		wincache_ucache_set('SES:' . $id, $doc, $this->session_lifetime);

        $result = $this->_mongo->update(array('_id' => $id), $doc, $options );

        return (!$result['ok'] == 1);
	}
		
	function _destroy($id)
	{
		$result = $this->_mongo->remove(array('_id' => $id));
		wincache_ucache_delete('SES:' . $id);
		
        return ($result['ok'] == 1); 
	}

	
	function _gc($session_lifetime)
	{
		// versja 2.2
		//mongodb Time-To-Live Collections
		//db.prisoners.ensureIndex({expire: 1}, {expireAfterSeconds: 24*60*60}
	
	
		$results = $this->_mongo->remove(
            array('expire' => array('$lt' => time()))
        );
	}
}

?>