<?php

/*
$string = preg_replace("/(\n)/", "__BR__", $string);

$string = str_replace("__BR__", "\r\n", $string);

*/

class Filter
{

	/**
	 *  @param	string	$string		String to filter before putting inside InnoDB
	 *  @return            			Filters and returns a valid string to put into the Database.
	 *  @note				If the $html arg is false, new lines (\n) will replaced with __BR__ and re-converted to \r\n afterwards.
	 * 					.. This is to ensure new lines are kept in place.
	 */

	public static function String( $string, $html = false ) {
		if(!$html) {
			$string = filter_var( $string , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		} else {
			$string = filter_var( $string , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		}
		return $string;
	}

	/**
	 *  @param	string	$email		Email to filter before putting inside InnoDB
	 *  @return            			Filters and returns a valid or invalid email address
	 */
	public static function Email( $email ) {
		return filter_var( $email , FILTER_SANITIZE_EMAIL);
	}

	/**
	 *  @param	string	$url		String to filter before putting inside InnoDB
	 *  @return            			Filters and returns a valid or invalid URL
	 */
	public static function URL( $url ) {
		return filter_var( $url , FILTER_SANITIZE_URL);
	}

	/**
	 *  @param	int		$integer	The string to filter and turn into an integer
	 *  @return	int					Returns an integer after being filtered.
	 */
	public static function Int( $integer ) {
		return (int) $integer = filter_var( $integer , FILTER_SANITIZE_NUMBER_INT);
	}

	/**
	 * @param string $image Image To Filter base code
	 * @return       Filters and return a valid or invalid
	 */
	public static function file($e) {
		$file = $_FILES["{$e}"]['name'];
		$file = Filter::String(strtolower(str_replace(' ','-', $file)));
		$allowed = ['png','jpeg','jpg','pdf','tiff','doc','docx','txt'];
		$file_type = pathinfo($file, PATHINFO_EXTENSION);
		if(in_array($file_type, $allowed)):
			$fileName = 'm_'.time().$file;
			return (string) $fileName;
		else:
			return false;
		endif;
	}

	public static function url_segm($segm, $e) {

	    if(isset($_GET["{$segm}"])):
	      $cl_url = $_GET["{$segm}"];
				$cl_url = preg_replace('/[^A-Za-z0-9\-\/]/', ' ', $cl_url);
				$cl_url = preg_replace('/\s+/', ' ', $cl_url);
	      $segm_array = explode('/', $cl_url);
	      if(isset($segm_array[$e])):
					if(strpos($segm_array[$e],' ') >= 1){
						$segma = substr($segm_array[$e],0,strpos($segm_array[$e],' '));
						return $segma;
					} else {
						return $segm_array[$e];
					}
	      else:
	        return false;
	      endif;
	    endif;
	}
}

?>
