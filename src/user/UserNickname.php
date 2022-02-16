<?php


namespace example\user;


class UserNickname
{

	/** @var string */
	protected $nickname;

	public function __construct(string $nickname){
		$this->nickname = $nickname;
	}

	public function user(): User{
		return User::fromNickname($this->nickname);
	}

}