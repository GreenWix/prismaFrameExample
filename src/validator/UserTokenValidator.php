<?php

declare(strict_types=1);


namespace example\validator;


use example\user\UserToken;
use example\validator\exception\WrongTokenException;
use GreenWix\prismaFrame\type\TypeValidator;

class UserTokenValidator extends TypeValidator {

	public function getFullTypeName(): string {
		return UserToken::class;
	}

	public function createAlsoArrayType(): bool {
		return false;
	}

	/**
	 * @throws WrongTokenException
	 */
	public function validateAndGetValue(string $input, array $extraData): UserToken {
		$isTokenValid = $input === "some_token";

		if(!$isTokenValid){
			throw new WrongTokenException("Wrong token");
		}

		return new UserToken($input);
	}
}