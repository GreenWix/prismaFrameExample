<?php

declare(strict_types=1);


namespace example\tests;


use example\user\User;
use PHPUnit\Framework\TestCase;

class UserTokenTest extends TestCase {

	public function testUserToken(): void{
		$user = User::fromToken("abcdef");

		echo "lol";

		$this->assertEquals("someUser", $user->nickname);
	}

}