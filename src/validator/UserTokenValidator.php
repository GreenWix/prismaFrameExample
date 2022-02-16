<?php

declare(strict_types=1);


namespace example\validator;


use example\user\UserToken;
use GreenWix\prismaFrame\error\runtime\RuntimeError;
use GreenWix\prismaFrame\error\runtime\RuntimeErrorException;
use GreenWix\prismaFrame\type\TypeValidator;

class UserTokenValidator extends TypeValidator {

	public function getFullTypeName(): string {
		return UserToken::class;
	}

	public function createAlsoArrayType(): bool {
		return false;
	}

	/**
	 * @throws RuntimeErrorException
	 */
	public function validateAndGetValue(string $input, array $extraData): UserToken {
		$isTokenValid = $input === "some_token";

		if(!$isTokenValid){
			throw RuntimeError::BAD_VALIDATION_RESULT("Wrong token");
		}

		return new UserToken($input);
	}
}