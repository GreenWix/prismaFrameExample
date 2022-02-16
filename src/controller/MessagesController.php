<?php

namespace example\controller;

use example\user\UserNickname;
use example\user\UserToken;
use GreenWix\prismaFrame\controller\Controller;

class MessagesController extends Controller{ // каждый контроллер должен наследовать класс Controller

	public function getName(): string{
		return "messages"; // имя контроллера
	}

	/**
	 * Отправка сообщения одному пользователю
	 *
	 * @httpMethod GET
	 *
	 * @param UserToken $token
	 * @param UserNickname $target
	 * @param string $message
	 * @return array
	 */
	public function sendMessage(UserToken $token, UserNickname $target, string $message): array{
		$user = $token->user(); // получаем нашего пользователя (отправителя)
		$nickname = $target->user()->nickname; // получаем никнейм получателя сообщения

		return [
			"data" => $user->send($message, $nickname)
		];
	}


	/**
	 * Отправка сообщения нескольким пользователям
	 *
	 * @httpMethod GET
	 *
	 * @param UserToken $token
	 * @param UserNickname[] $targets Обратите внимание на []
	 * @param string $message
	 * @return array
	 */
	public function sendMessageForUsers(UserToken $token, array $targets, string $message): array{
		$user = $token->user(); // получаем нашего пользователя (отправителя)
		$data = [];

		foreach($targets as $target){
			$nickname = $target->user()->nickname; // получаем никнейм получателя сообщения
			$data[$nickname] = $user->send($message, $nickname);
		}

		return [
			"data" => $data
		];
	}

}