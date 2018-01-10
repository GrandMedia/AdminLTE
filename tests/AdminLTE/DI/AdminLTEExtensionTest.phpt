<?php declare(strict_types = 1);

namespace GrandMediaTests\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use Nette\Configurator;
use Nette\DI\Container;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class AdminLTEExtensionTest extends \Tester\TestCase
{

	public function testFunctionality(): void
	{
		$container = $this->createContainer(null);

		$container->getByType(MainMenuFactory::class);
		$container->getByType(NavigationBarMenuFactory::class);

		Assert::true(true);
	}

	private function createContainer(?string $configFile): Container
	{
		$config = new Configurator();

		$config->setTempDirectory(\TEMP_DIR);
		$config->addConfig(__DIR__ . '/config/reset.neon');
		if ($configFile !== null) {
			$config->addConfig(__DIR__ . \sprintf('/config/%s.neon', $configFile));
		}

		return $config->createContainer();
	}

}

(new AdminLTEExtensionTest())->run();
