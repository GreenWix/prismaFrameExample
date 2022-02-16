<?php

namespace example\user;

class User{

	public $nickname;

	public static function fromNickname(string $nickname): User{
		return new User($nickname);
	}

	public static function fromToken(string $token): User{
		return new User('someUser');
	}

	private function __construct(string $nickname){
		$this->nickname = $nickname;
	}

	public function send(string $message, string $nickname): string{
		return 'sent ' . $message . ' from ' . $this->nickname . ' to ' . $nickname;
	}

}