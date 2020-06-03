<?php


namespace example\user;


use GreenWix\prismaFrame\error\runtime\RuntimeError;
use GreenWix\prismaFrame\type\SupportedType;

class UserNickname extends SupportedType
{

	public function user(): User{
		return User::fromNickname($this->input);
	}

	public function validate(string $var, array $extraData)
	{
		if(preg_match("/[^A-Za-z0-9_ ]/", $var) !== 0){
			throw RuntimeError::BAD_VALIDATION_RESULT("Nickname \"{$var}\" can't exists");
		}

		// ...some checks
		$exists = $var === "noliktop" || $var === "encritary" || $var === "andrew1481432";
		if(!$exists){
			throw RuntimeError::BAD_VALIDATION_RESULT("Nickname \"{$var}\" does not exists");
		}

		return new UserNickname($var, $extraData);
	}

	public function isArrayType(): bool
	{
		return true;
	}
}