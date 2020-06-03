<?php


namespace example\controller;


use example\user\UserNickname;
use example\user\UserToken;
use GreenWix\prismaFrame\controller\Controller;

class TestController extends Controller
{

	public function getName(): string
	{
		return "test";
	}

	/**
	 * @httpMethod GET|POST
	 *
	 * @param int $db
	 * @param int $da
	 * @return array
	 */
	public function rar(int $db, int $da = 228): array{
		return ["da" => $da, "db" => $db];
	}

	/**
	 * @httpMethod GET
	 *
	 * @param UserToken $token
	 * @param UserNickname[] $users
	 * @param string $message
	 * @return array
	 */
	public function sendMessage(UserToken $token, array $users, string $message): array{
		$user = $token->user();

		return [
			"data" => $user->send($message, $users)
			];
	}

	/**
	 * @httpMethod GET
	 *
	 * @param UserToken $token
	 * @param UserNickname $user
	 * @param string $message
	 * @return array
	 */
	public function sendMessageForOne(UserToken $token, UserNickname $user, string $message): array{
		$user = $token->user();

		return [
			"data" => $user->send($message, [$user])
			];
	}


}