<?php
/**
 * 
 * Enter description here ...
 * @author vinh.nguyen
 *
 */
class Util {
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $length
	 */
	public static function generateString($length = 8) {
		$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$len = strlen ( $salt );
		$makepass = '';
		
		$stat = @stat ( __FILE__ );
		if (empty ( $stat ) || ! is_array ( $stat ))
			$stat = array (php_uname () );
		
		mt_srand ( crc32 ( microtime () . implode ( '|', $stat ) ) );
		
		for($i = 0; $i < $length; $i ++) {
			$makepass .= $salt [mt_rand ( 0, $len - 1 )];
		}
		
		return $makepass;
	}
	
	/**
	 * Encryption routines that uses XOR should be considered secure.
	 *
	 * @param mixed $string
	 * @return string
	 */
	public static function encrypt($string) {
		
		$key = 'BaI123vUI!@#';
		$result = '';
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) + ord ( $keychar ) );
			$result .= $char;
		}
		$string = str_replace ( '+', ':gplus:', base64_encode ( $result ) );
		return urlencode ( $string );
	}
	/**
	 * decryption routines that uses XOR should be considered secure.
	 * 
	 * @param string $string
	 */
	public static function decrypt($string) {
		$key = 'BaI123vUI!@#';
		$result = '';
		$string = str_replace ( ':gplus:', '+', urldecode ( $string ) );
		$string = base64_decode ( $string );
		for($i = 0; $i < strlen ( $string ); $i ++) {
			$char = substr ( $string, $i, 1 );
			$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
			$char = chr ( ord ( $char ) - ord ( $keychar ) );
			$result .= $char;
		}
		return $result;
	}
	
	/**
	 * This function generates 11 digit (pseudo)unique ids
	 * @return string
	 */
	public static function getUniqueId() {
		$id = uniqid ();
		// $alpha = "bcdfghjklmnopqrstvwxyz0123456789";
		$alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		for($i = 0; $i < strlen ( $id ); $i ++) {
			//$binid .= $hexbin_arr[$id[$i]];
			$binid_p [$i] = str_pad ( decbin ( hexdec ( $id [$i] ) ), 4, '0', STR_PAD_LEFT );
		}
		shuffle ( $binid_p );
		$binid = implode ( '', $binid_p );
		$id_arr = explode ( ' ', chunk_split ( $binid, 5, ' ' ) );
		$fin_id = '';
		foreach ( $id_arr as $id_part ) {
			if (! ($id_part == '')) {
				$id_p = str_pad ( $id_part, 5, '0', STR_PAD_LEFT );
				$fin_id .= $alpha [bindec ( $id_p )];
			}
		}
		return $fin_id;
	}
	/**
	 * Random number
	 * @param $length
	 */
	public static function randomDigits($length){
	    $numbers = range(0,9);
	    shuffle($numbers);
	    $digits = '';
	    for($i = 0;$i < $length;$i++){
	       $digits .= $numbers[$i];
	    }
	    return $digits;
	}
	/**
	 * get session
	 * @return Zend_Session_Namespace
	 */
	public static function getSession() {
		try {
			$session = Yii::app ()->session;
			if (! $session->isStarted) {
				$session->open ();
			}
			return $session;
		} catch ( Exception $e ) {
			return null;
		}
	}
	/**
	 * generate a token
	 * 
	 * @param mixed $generate
	 * @return string
	 */
	public static function accessToken($generate = false, $value) {
		try {
			$session = self::getSession ();
			$session->setTimeout ( 900 );
			if ($generate) {
				$ts = $value;
				$session->add ( 'access_token', $ts );
			} else {
				$ts = $session->get ( 'access_token' );
				if (! $ts) {
					$ts = $value;
					$session->add ( 'access_token', $ts );
				}
			}
			return $ts;
		} catch ( Exception $e ) {
			return '';
		}
	}
	/**
	 * clear current token
	 * 
	 * @param mixed $generate
	 * @return string
	 */
	public static function clearToken() {
		$session = self::getSession ();
		$session->remove ( 'access_token' );
	}
	/**
	 * Write cookie
	 */
	public static function writeCookie($data, $cookietimeout = -1) {
		$value = json_encode ( $data ['value'] );
		$value = self::encrypt ( $value ) . '|' . time () . '|' . md5 ( $value . time () );
		$Cookie = new CHttpCookie ( $data ['name'], $data ['valueDefault'] );
		$Cookie->value = $value;
		
		//set cookietimeout
		if($cookietimeout == -1)
			$Cookie->expire = time () + Yii::app ()->params->cookie ['expire'];
		else 	
			$Cookie->expire = time () + $cookietimeout;	
		
		$Cookie->path = Yii::app ()->params->cookie ['path'];
		$Cookie->domain = Yii::app ()->params->cookie ['domain'];
		Yii::app ()->request->cookies [$data ['name']] = $Cookie;
		return $Cookie;
	}
	
	public static function getCookie($name) {		
		$cookie = Yii::app ()->request->cookies [$name];
		if(isset($cookie->value)) {
			$cookie = explode('|', $cookie->value);
			$cookie = self::decrypt($cookie[0]);
			return json_decode($cookie, true);
		}
		return null;
	}
	
	public static function clearCookie($name) {
		return setcookie ($name, "", time() - 3600, Yii::app ()->params->cookie ['path'], Yii::app ()->params->cookie ['domain']);
	}
	
	public static function skipNotifyUpdate(){
		$session = self::getSession ();
		$session->setTimeout ( 900 );
		$session->add ( 'skip_update', true);		
		return true;
	}
	
	public static function notifyUpdate($user){	
		return false;
		$session = self::getSession ();
		$skip = $session->get ( 'skip_update' );			
		$pfAttributes = $user->profile->attributes;
		if(empty($pfAttributes['cmnd']) && empty($pfAttributes['address']) && empty($pfAttributes['country']) && empty($pfAttributes['state']) && empty($skip)){			
			return true;
		}
		return false;
	}

	public static function unescapeHtml($data){
		$data = str_replace("&amp;", "&", $data);
		$data = str_replace("&quot;", '"', $data);
		$data = str_replace("&#39;", "'", $data);
		$data = str_replace("&lt;", "<", $data);
		$data = str_replace("&gt;", ">", $data);
		return $data;
	}
	
	public static function utf8Urldecode($str) {
	    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
	    return html_entity_decode($str,null,'UTF-8');;
  	}
  	
	public static function getCurrentUrl($no_query = true){
		$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
		// Get domain portion
		$myUrl .= '://'.$_SERVER['HTTP_HOST'];
		// Get path to script
		$myUrl .= isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : null;
		if (!$no_query){
			$myUrl .= "?" . $_SERVER['QUERY_STRING']; 
		}
		// Add path info, if any
		//if (!empty($_SERVER['PATH_INFO'])) $myUrl .= $_SERVER['PATH_INFO'];
		return $myUrl;
	}
	
	public static function getCurrentDomain($url = ""){
		$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
		// Get domain portion
		$myUrl .= '://'.$_SERVER['HTTP_HOST'];
		return $url == "" ? $myUrl : $myUrl . $url ;
	}
	
	public static function setMessage($title, $content){
		$data = array('value'=> array('title' => $title, 'content' => $content), 'valueDefault'=>serialize('message'), 'name'=>'message');
		Util::writeCookie($data, 86400);
	}
	
	public static function getElapsedTime($timestamp, $precision = 2) {
		$time = time () - $timestamp;
		$a = array ('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'sec' => 1 );
		$i = 0;
		foreach ( $a as $k => $v ) {
			$$k = floor ( $time / $v );
			if ($$k)
				$i ++;
			$time = $i >= $precision ? 0 : $time - $$k * $v;
			$s = $$k > 1 ? 's' : '';
			$$k = $$k ? $$k . ' ' . $k . $s . ' ' : '';
			@$result .= $$k;
		}
		return $result ? $result.'ago' : '1 sec to go';
	}

	public static function partString($str, $start, $length = 10, $encoding = 'UTF-8'){
		$result = '';
		$strlen = mb_strlen($str, 'UTF-8');		
		if($strlen > $length){
			if(function_exists('mb_substr')){
				$result = mb_substr($str, $start, $length, $encoding);
			}else{
				$result = substr($str, $start, $length);
			}
			$result .= '...';
		}else{
			$result = $str; 
		}
		return $result;
	}

	public static function remoteFileExists($url) {
	    $curl = curl_init($url);
	
	    //don't fetch the actual page, you only want to check the connection is ok
	    curl_setopt($curl, CURLOPT_NOBODY, true);
	
	    //do request
	    $result = curl_exec($curl);
	
	    $ret = false;
	
	    //if request did not fail
	    if ($result !== false) {
	        //if request was ok, check response code
	        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
	
	        if ($statusCode == 200) {
	            $ret = true;   
	        }
	    }
	
	    curl_close($curl);
	
	    return $ret;
	}
	
	public static function trimUrl($url){
		$tmp = $url;
		
		if (strpos($tmp, "/") !== false && strpos($tmp, "/") == 0)
			$tmp = substr($tmp, 1);
		
		if (strpos($tmp, "\\") !== false && strpos($tmp, "\\") == 0)
			$tmp = substr($tmp, 1);
			
		return $tmp;
	}
	
	public static function mcrypt_encrypt($string, $key='abc123ABC'){
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
		$encrypted = str_replace ( array('+','/','='),array('abc123ABC','_',''),  $encrypted );
		return $encrypted;
	}
	
	public static function mcrypt_decrypt($encrypted, $key='abc123ABC'){
		$encrypted = str_replace(array('abc123ABC','_'),array('+','/'),$encrypted);
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		return $decrypted;
	}
	
	public static function encryptRandCode($string){
		$string = $string.'_____'.time();
		return self::mcrypt_encrypt($string);
	}
	
	public static function decryptRandCode($encrypted){
		$decrypted = self::mcrypt_decrypt($encrypted);
		$arr = explode('_____', $decrypted);
		return $arr[0];
	}
	
	/**
	 * trim string : "this is the     trim ", to : "this is the trim" 
	 * @param unknown_type $text
	 */
	public static function trimString($text){
		$text = trim($text);
		$text = preg_replace('/\s+/',' ',$text);
		return $text;
	}
	
	public static function trimArray($array){
		foreach ($array as $key => $item){
			$array[$key] = Util::trimString($item);
		}
		
		return $array;
	}
	
	private static function seems_utf8($str)
    {
        $length = strlen($str);
        for ($i=0; $i < $length; $i++) {
            $c = ord($str[$i]);
            if ($c < 0x80) $n = 0; # 0bbbbbbb
            elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
            elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
            elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
            elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
            elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
            else return false; # Does not match any model
            for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
                if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                    return false;
            }
        }
        return true;
    }
	
	public static function removeUnicode($string)
    {
        if ( !preg_match('/[\x80-\xff]/', $string) )
            return $string;

        if (Util::seems_utf8($string)) {
        	
        	$string = preg_replace("/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $string); 
            $string = str_replace("ç","c",$string); 
            $string = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $string); 
            $string = preg_replace("/(ì|í|î|ị|ỉ|ĩ)/", 'i', $string); 
            $string = preg_replace("/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $string); 
            $string = preg_replace("/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $string); 
            $string = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $string); 
            $string = preg_replace("/(đ)/", 'd', $string); 
            
            $string = preg_replace("/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $string); 
            $string = str_replace("Ç","C",$string); 
            $string = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $string); 
            $string = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $string); 
            $string = preg_replace("/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $string); 
            $string = preg_replace("/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $string); 
            $string = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $string); 
            $string = preg_replace("/(Đ)/", 'D', $string);
            
            $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
            chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
            chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
            chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
            chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
            chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
            chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
            chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
            chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
            chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
            chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
            chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
            // Euro Sign
            chr(226).chr(130).chr(172) => 'E',
            // GBP (Pound) Sign
            chr(194).chr(163) => '');

            $string = strtr($string, $chars);
        } else {
            // Assume ISO-8859-1 if not UTF-8
            $chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
                .chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
                .chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
                .chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
                .chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
                .chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
                .chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
                .chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
                .chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
                .chr(252).chr(253).chr(255);

            $chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

            $string = strtr($string, $chars['in'], $chars['out']);
            $double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
            $double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
            $string = str_replace($double_chars['in'], $double_chars['out'], $string);
        }

        return $string;
    }
    
    public static function getSlug($text){
    	$text = Util::trimString($text);
    	$text = Util::removeUnicode($text);
    	$text = strtolower($text);
    	$text = str_replace(' ', '-', $text);
    	return $text;
    }
    
    public static function in_multiarray($elem, $array,$field)
    {
    	$top = sizeof($array) - 1;
    	$bottom = 0;
    	while($bottom <= $top)
    	{
    		if($array[$bottom][$field] == $elem)
    			return true;
    		else
    			if(is_array($array[$bottom][$field]))
    			if(in_multiarray($elem, ($array[$bottom][$field])))
    			return true;
    
    		$bottom++;
    	}
    	return false;
    }
    
    public static function setCookie($name, $value, $time = 3600) {
	    $cookie = new CHttpCookie($name, $value);
	    $cookie->expire = time()+$time;
	    Yii::app()->request->cookies[$name] = $cookie;
    }
}