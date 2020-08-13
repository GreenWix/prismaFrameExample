<?php

namespace example\error\service;

use GreenWix\prismaFrame\error\HTTPCodes;
use GreenWix\prismaFrame\error\runtime\RuntimeErrorException;

final class ServiceError {

	// static class
	private function __construct() {}

	public static function SOMETHING(): RuntimeErrorException{
		return new RuntimeErrorException(
			ServiceErrorCodes::SOMETHING,
			"Something went wrong",
			HTTPCodes::INTERNAL_SERVER_ERROR
		);
	}

	public static function RPS_LIMIT_REACHED(): RuntimeErrorException{
		return new RuntimeErrorException(
			ServiceErrorCodes::RPS_LIMIT_REACHED,
			"Too many requests",
			HTTPCodes::TOO_MANY_REQUESTS
		);
	}

}