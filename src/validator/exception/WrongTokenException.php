<?php

declare(strict_types=1);


namespace example\validator\exception;


use example\validator\ErrorCodes;
use Exception;
use GreenWix\prismaFrame\error\HTTPCodes;
use GreenWix\prismaFrame\type\validators\exception\ValidatorException;

class WrongTokenException extends ValidatorException {

	public function __construct(string $message, Exception $previous = null) {
		parent::__construct(ErrorCodes::WRONG_TOKEN, $message, HTTPCodes::BAD_REQUEST, $previous);
	}

}