<?php declare(strict_types = 1);

namespace GrandMediaTests\AdminLTE\DI;

use GrandMedia\AdminLTE\Components\ContentHeaderFactory;
use GrandMedia\AdminLTE\Components\FooterFactory;
use GrandMedia\AdminLTE\Components\HeaderFactory;
use GrandMedia\AdminLTE\Components\MainMenuFactory;
use GrandMedia\AdminLTE\Components\NavigationBarFactory;
use GrandMedia\AdminLTE\Components\NavigationBarMenuFactory;
use GrandMedia\AdminLTE\Components\SidebarFactory;
use GrandMedia\AdminLTE\Forms\FormFactory;
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

		$container->getByType(ContentHeaderFactory::class);
		$container->getByType(FooterFactory::class);
		$container->getByType(HeaderFactory::class);
		$container->getByType(MainMenuFactory::class);
		$container->getByType(NavigationBarFactory::class);
		$container->getByType(NavigationBarMenuFactory::class);
		$container->getByType(SidebarFactory::class);

		/** @var \GrandMedia\Widgets\Items $headerItems */
		$headerItems = $container->getService('headerItems');
		Assert::same(1, \count($headerItems->getIndexes()));

		/** @var \GrandMedia\Widgets\Items $navigationBarItems */
		$navigationBarItems = $container->getService('navigationBarItems');
		Assert::same(1, \count($navigationBarItems->getIndexes()));

		/** @var \GrandMedia\Widgets\Items $sidebarItems */
		$sidebarItems = $container->getService('sidebarItems');
		Assert::same(1, \count($sidebarItems->getIndexes()));

		$container->getByType(FormFactory::class);
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
