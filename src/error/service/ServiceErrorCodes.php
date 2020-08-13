<?php

namespace example\error\service;

interface ServiceErrorCodes {

	const SOMETHING = 0xA00; // что-нибудь
	const RPS_LIMIT_REACHED = 0xA01; // пользователь делает слишком много запросов в секунду

}