<?php

declare(strict_types=1);


namespace example\validator\exception;


use example\validator\ErrorCodes;
use Exception;
use GreenWix\prismaFrame\error\HTTPCodes;
use GreenWix\prismaFrame\type\validators\exception\ValidatorException;

class UserDoesNotExistException extends ValidatorException {

	public function __construct(string $message, Exception $previous = null) {
		parent::__construct(ErrorCodes::USER_DOES_NOT_EXIST, $message, HTTPCodes::BAD_REQUEST, $previous);
	}

}