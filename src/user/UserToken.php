<?php


namespace example\user;


class UserToken
{

	protected $token;

	public function __construct(string $token) {
		$this->token = $token;
	}

	public function user(): User{
		return User::fromToken($this->token);
	}

}