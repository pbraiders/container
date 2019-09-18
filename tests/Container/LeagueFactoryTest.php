<?php

declare(strict_types=1);

namespace PbraidersTest\Container;

use Pbraiders\Container\LeagueFactory;
use PbraidersTest\Utils\ServiceProvider;
use Psr\Container\ContainerInterface;

class LeagueFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Container\LeagueFactory
     * @group specification
     */
    public function testCreateContainer()
    {
        $aFactories1 = [
            'service3' => static function (\Psr\Container\ContainerInterface $container): string {
                return 'I_am_service_3';
            },
            'service4' => static function (\Psr\Container\ContainerInterface $container): string {
                return 'I_am_service_4';
            },
        ];

        $aFactories2 = [
            'service5' => static function (\Psr\Container\ContainerInterface $container): string {
                return 'I_am_service_5';
            },
            'service6' => static function (\Psr\Container\ContainerInterface $container): string {
                return 'I_am_service_6';
            },
        ];

        $aInvokables = [
            ServiceProvider::class,
        ];

        $pFactory = new LeagueFactory();
        $pFactory->registerDefinition('service_provider', $aInvokables, false, true);
        $pFactory->registerDefinition('factory_shared', $aFactories1, true);
        $pFactory->registerDefinition('factory', $aFactories2);
        $pContainer = $pFactory->createContainer();

        $this->assertTrue($pContainer instanceof ContainerInterface);
        $this->assertTrue($pContainer->has('service1'), 'container has service1');
        $this->assertTrue($pContainer->has('service2'), 'container has service2');
        $this->assertTrue($pContainer->has('service3'), 'container has service3');
        $this->assertTrue($pContainer->has('service4'), 'container has service4');
        $this->assertTrue($pContainer->has('service5'), 'container has service5');
        $this->assertTrue($pContainer->has('service6'), 'container has service6');

        $this->assertSame('I_am_service_1', $pContainer->get('service1'), 'Is service1');
        $this->assertSame('I_am_service_2', $pContainer->get('service2'), 'Is service2');
        $this->assertSame('I_am_service_3', $pContainer->get('service3'), 'Is service3');
        $this->assertSame('I_am_service_4', $pContainer->get('service4'), 'Is service4');
        $this->assertSame('I_am_service_5', $pContainer->get('service5'), 'Is service5');
        $this->assertSame('I_am_service_6', $pContainer->get('service6'), 'Is service6');
    }
}
