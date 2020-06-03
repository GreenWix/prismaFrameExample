<?php


namespace example\user;


class User
{

	public $nickname;

	private function __construct(string $nickname){
		$this->nickname = $nickname;
	}

	public static function fromNickname(string $nickname): User{
		return new User($nickname);
	}

	public static function fromToken(string $token): User{
		return new User("someUser");
	}

	public function send(string $message, array $users): string{
		$nicknames = implode(",", array_map(
			static function(UserNickname $el){
				return $el->user()->nickname;
			}, $users)
		);
		return "sent " . $message . " to " . $nicknames;
	}

}