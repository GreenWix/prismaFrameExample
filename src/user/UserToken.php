<?php


namespace example\user;


use GreenWix\prismaFrame\error\runtime\RuntimeError;
use GreenWix\prismaFrame\error\runtime\RuntimeErrorException;
use GreenWix\prismaFrame\type\SupportedType;

class UserToken extends SupportedType
{

	public function user(): User{
		return User::fromToken($this->input);
	}

	public function isArrayType(): bool
	{
		return false;
	}

	/**
	 * @param string $var
	 * @param array $extraData
	 * @return UserToken
	 * @throws RuntimeErrorException
	 */
	public function validate(string $var, array $extraData){

		// ...some checks
		$isTokenValid = $var === "some_token";

		if(!$isTokenValid){
			throw RuntimeError::BAD_VALIDATION_RESULT("Wrong token");
		}

		return new UserToken($var, $extraData);
	}
}