<?php

namespace example\db;

use example\security\Security;
use GreenWix\prismaFrame\error\runtime\RuntimeError;
use GreenWix\prismaFrame\error\security\SecurityError;
use GreenWix\prismaFrame\error\security\SecurityErrorException;
use mysqli;
use Throwable;

final class MySQL {

	// static class
	private function __construct() {}

	const HOST = '';
	const USER = '';
	const DB = '';
	const PASSWORD = '';

	/** @var mysqli */
	private static $db;

	/**
	 * @return mysqli
	 * @throws SecurityErrorException
	 */
	public static function db(): mysqli{
		try {
			if (self::$db === null || !self::$db->ping()) {
				self::$db = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DB);
			}
		}catch (Throwable $e){
			Security::report("cant connect db. " . $e->getMessage());
			throw SecurityError::CUSTOM_SECURITY_ISSUE('Cant connect db');
		}

		return self::$db;
	}

}