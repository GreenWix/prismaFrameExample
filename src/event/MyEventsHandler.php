<?php

declare(strict_types=1);


namespace example\event;


use GreenWix\prismaFrame\event\EventsHandler;
use GreenWix\prismaFrame\event\request\AfterRequestEvent;
use GreenWix\prismaFrame\event\request\BeforeRequestEvent;

class MyEventsHandler extends EventsHandler {

	public function beforeRequest(BeforeRequestEvent $e) {
		// ...
	}

	public function afterRequest(AfterRequestEvent $e) {
		// ...
	}
}