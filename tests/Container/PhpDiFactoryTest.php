<?php

declare(strict_types=1);

namespace PbraidersTest\Container;

use Pbraiders\Container\PhpDiFactory;
use Psr\Container\ContainerInterface;

class PhpDiFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Cache directory.
     *
     * @var string
     */
    protected static $sCacheDirectory = __DIR__ . '/tmp';

    /**
     * Proxies directory.
     *
     * @var string
     */
    protected static $sProxyDirectory = __DIR__ . '/tmp/proxies';

    /**
     * Create cache directories.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        foreach ([self::$sCacheDirectory, self::$sProxyDirectory] as $sDirectory) {
            if (! is_dir($sDirectory)) {
                if (! mkdir($sDirectory, 0777, true)) {
                    die(\sprintf('Failed to create folder %s', $sDirectory));
                }
            }
        }
    }

    /**
     * Delete the cache directories.
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        if (is_file(self::$sCacheDirectory . DIRECTORY_SEPARATOR . 'CompiledContainer.php')) {
            unlink(self::$sCacheDirectory . DIRECTORY_SEPARATOR . 'CompiledContainer.php');
        }
        foreach ([self::$sProxyDirectory, self::$sCacheDirectory] as $sDirectory) {
            if (is_dir($sDirectory)) {
                if (! rmdir($sDirectory)) {
                    die(\sprintf('Failed to delete folder %s', $sDirectory));
                }
            }
        }
    }

    /**
     * @covers \Pbraiders\Container\PhpDiFactory
     * @group specification
     */
    public function testCreateContainerBadCacheDirectoryException()
    {
        $pFactory = new PhpDiFactory();
        $pFactory->disableProxy();
        $pFactory->setCacheDirectory('doesnotexists');
        $this->expectException(\RuntimeException::class);
        $pFactory->createContainer();
    }

    /**
     * @covers \Pbraiders\Container\PhpDiFactory
     * @group specification
     */
    public function testCreateContainerBadProxiesDirectoryException()
    {
        $pFactory = new PhpDiFactory();
        $pFactory->disableCompilation();
        $pFactory->setProxyDirectory('doesnotexists');
        $this->expectException(\RuntimeException::class);
        $pFactory->createContainer();
    }

    /**
     * @covers \Pbraiders\Container\PhpDiFactory
     * @group specification
     */
    public function testCreateContainer()
    {
        $aFactories2 = [
            'service5' => static function (): string {
                return 'I_am_service_5';
            },
            'service6' => static function (): string {
                return 'I_am_service_6';
            },
        ];

        $aInvokables = [
            'simple' => \stdClass::class,
        ];

        $pFactory = new PhpDiFactory();
        $pFactory->setCacheDirectory(self::$sCacheDirectory);
        $pFactory->setProxyDirectory(self::$sProxyDirectory);
        $pFactory->registerDefinition('factories', $aFactories2);
        $pFactory->registerDefinition('invokables', $aInvokables);
        $pContainer = $pFactory->createContainer();
        $this->assertTrue($pContainer instanceof ContainerInterface);
        $this->assertTrue(is_readable(self::$sCacheDirectory . DIRECTORY_SEPARATOR . 'CompiledContainer.php'));

        $this->assertTrue($pContainer->has(\stdClass::class), 'container has \stdClass::class');
        $this->assertTrue($pContainer->has('service5'), 'container has service5');
        $this->assertTrue($pContainer->has('service6'), 'container has service6');

        $this->assertSame('I_am_service_5', $pContainer->get('service5'), 'Is service5');
        $this->assertSame('I_am_service_6', $pContainer->get('service6'), 'Is service6');
    }
}
