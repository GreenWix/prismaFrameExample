<?php

use example\user\UserNickname;
use example\user\UserToken;
use GreenWix\prismaFrame\error\HTTPCodes;
use Laminas\Diactoros\Response\JsonResponse;
use example\controller\TestController;
use GreenWix\prismaFrame\error\internal\InternalErrorException;
use GreenWix\prismaFrame\PrismaFrame;
use GreenWix\prismaFrame\settings\PrismaFrameSettings;
use GreenWix\prismaFrame\error\Error;

ini_set('display_errors', 'stderr');
include "vendor/autoload.php";

$relay = new Spiral\Goridge\StreamRelay(STDIN, STDOUT);
$psr7 = new Spiral\RoadRunner\PSR7Client(new Spiral\RoadRunner\Worker($relay));

PrismaFrame::init(new PrismaFrameSettings(true, "0.0.1"));

PrismaFrame::addSupportedType(new UserToken());
PrismaFrame::addSupportedType(new UserNickname());

PrismaFrame::addController(new TestController());
PrismaFrame::start();

while ($req = $psr7->acceptRequest()) {
	try {

		$resp = PrismaFrame::handle($req->getUri()->getPath(), $req->getMethod(), $req->getQueryParams());
		$response = new JsonResponse($resp->response, $resp->httpCode, [], JSON_UNESCAPED_UNICODE);

		$psr7->respond($response);
	} catch (Throwable $e) {
		$psr7->getWorker()->error((string)$e);
	}
}