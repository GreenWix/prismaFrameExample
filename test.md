Поддерживаемые типы есть, контроллеры в боевой готовности, Security сделан. Что дальше?

## Перед тестированием
Возьмем [runner.php](https://github.com/GreenWix/prismaFrameExample/blob/master/runner.php)

Добавим поддерживаемые типы:
```php
$prismaFrame->addTypeValidator(new TypeNameValidator());
```

Добавим контроллеры при помощи:
```php
$prismaFrame->addController(new SomeController());
```

Должно получиться примерно такое:
```php
<?php

use example\event\MyEventsHandler;
use example\validator\UserNicknameValidator;
use example\validator\UserTokenValidator;
use Laminas\Diactoros\Response\JsonResponse;
use example\controller\MessagesController;
use GreenWix\prismaFrame\PrismaFrame;
use GreenWix\prismaFrame\settings\PrismaFrameSettings;

use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;

ini_set('display_errors', 'stderr');
include "vendor/autoload.php";

//region init worker
$worker = Worker::create();
$factory = new Psr17Factory();
$psr7 = new PSR7Worker($worker, $factory, $factory, $factory);
//endregion

//region init prismaFrame
$settings = new PrismaFrameSettings(true, "0.0.1");
$eventsHandler = new MyEventsHandler();
$logger = $worker->getLogger();
$prismaFrame = new PrismaFrame($settings, $eventsHandler, $logger);

$prismaFrame->addTypeValidator(new UserTokenValidator());
$prismaFrame->addTypeValidator(new UserNicknameValidator());

$prismaFrame->addController(new MessagesController());

$prismaFrame->start();
//endregion

while (true) {
	try {
		$request = $psr7->waitRequest();

		$resp = $prismaFrame->handleRequest($request);
		$response = new JsonResponse($resp->response, $resp->httpCode, [], JSON_UNESCAPED_UNICODE);

		$psr7->respond($response);

	} catch (Throwable $e) {
		$worker->error((string)$e);
	}
}
```

## Запускаем
```console
./rr serve -d
```

Если у вас нет бинарного файла rr - получите его введя
```console
composer require spiral/roadrunner
./vendor/bin/rr get
```

## Программа для тестирования API

Есть замечательная программа [Postman](https://www.postman.com/).

![скриншот из программы](https://sun9-21.userapi.com/UiqW7trRQ1bvNdFC_HjHFTFJzy9VL3f79f35PQ/0hpqdhbDd3s.jpg)

## Тестируем

Нажмите на маленький плюсик сверху и вбейте в адрес
```http
http://127.0.0.1:8080/messages.sendMessage?v=0.0.1&token=some_token&target=noliktop&message=lol
```

Должно получиться вот так:
![скриншот из программы](https://sun9-5.userapi.com/0d_qffNLqrfvSJhoOosXWQPRNd-YTDrZGLHdng/WsOjHKwvaWk.jpg)

Вуаля! Все работает🥳

Теперь Вы научились использовать **prismaFrame**.

Приятной разработки! 🔧