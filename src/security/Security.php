<?php

namespace example\security;

use example\error\service\ServiceError;
use GreenWix\prismaFrame\error\runtime\RuntimeErrorException;
use Psr\Http\Message\ServerRequestInterface;

final class Security {

	// static class
	private function __construct() {}

	private static $request;

	/**
	 * @param ServerRequestInterface $request
	 * @throws RuntimeErrorException
	 */
	public static function beforeRequest(ServerRequestInterface $request){
		self::$request = $request;

		self::checkForRequestsLimit();

		self::someChecks();
	}

	public static function someChecks(){
		//
	}

	/**
	 * @throws RuntimeErrorException
	 */
	public static function checkForRequestsLimit(){
		//
		$rps = mt_rand(5, 10); // так делать не надо, это лишь для примера!
		if($rps === 10){
			throw ServiceError::RPS_LIMIT_REACHED();
		}
	}

	/**
	 * @param string $message
	 */
	public static function report(string $message): void{
		//куда-нибудь репортим, например в вк
		static $token = 'some token';

		$result = <<<TXT
@noliktop срочно сюда тут все сломалось
{$message}
TXT;

		$peerId = 2e9 + 1;

		file_get_contents(
			'https://api.vk.com/method/messages.send?access_token=' . $token . '&v=5.122&message=' . urlencode($result) . '&random_id=0&peer_id=' . $peerId
		);
	}

}