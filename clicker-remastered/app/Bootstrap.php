<?php

declare(strict_types=1);

namespace App;

use Nette\Configurator;
use Tracy\Debugger;

class Bootstrap
{

	public static function boot(): Configurator
	{
		Debugger::$showLocation = true;
		$configurator = new Configurator;

		$configurator->setDebugMode([
			'212.79.110.141', // Plzeň byt Papírna
			'89.103.65.133', // exapos
		]);

		$configurator->enableTracy(__DIR__ . '/../log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory(__DIR__ . '/../temp');
		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator
			->addConfig(__DIR__ . '/config/common.neon')
			->addConfig(__DIR__ . '/config/config.local.neon');

		return $configurator;
	}

	public static function bootForTests(): Configurator
	{
		$configurator = self::boot();
		\Tester\Environment::setup();
		return $configurator;
	}
}
