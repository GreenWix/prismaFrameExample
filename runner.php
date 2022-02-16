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