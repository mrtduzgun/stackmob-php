<?php


class SMRestMethod {

	const POST 		= 1;
	const GET 		= 2;
	const PUT 		= 3;
	const DELETE 	= 4;

	public static function isValidMethod($method) {
		return in_array($method, array(self::POST, self::GET, self::PUT, self::DELETE));
	}
}
?>