<?php declare(strict_types = 1);

namespace GrandMediaTests\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\MainMenuWidgetFactory;
use GrandMedia\AdminLTE\Components\TopBarWidgetFactory;
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

		$container->getByType(MainMenuWidgetFactory::class);
		$container->getByType(TopBarWidgetFactory::class);

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
