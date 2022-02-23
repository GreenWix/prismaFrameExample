<?php

declare(strict_types=1);


namespace example\validator;


use example\user\UserNickname;
use example\validator\exception\UserDoesNotExistException;
use example\validator\exception\WrongNicknameException;
use GreenWix\prismaFrame\type\TypeValidator;

class UserNicknameValidator extends TypeValidator {

	public function getFullTypeName(): string {
		return UserNickname::class;
	}

	public function createAlsoArrayType(): bool {
		return true;
	}

	public function validateAndGetValue(string $input, array $extraData): UserNickname {
		if(preg_match("/[^A-Za-z0-9_ ]/", $input) !== 0){
			throw new WrongNicknameException("Nickname \"$input\" can't exists");
		}

		// ...some checks

		$existingNicknames = ["noliktop", "encritary", "andrew1481432"];

		$exists = in_array($input, $existingNicknames, true);
		if(!$exists){
			throw new UserDoesNotExistException("Nickname \"$input\" does not exists");
		}

		return new UserNickname($input);
	}
}