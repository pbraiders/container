<?php

declare(strict_types=1);

namespace PbraidersTest\Container;

use PbraidersTest\Utils\EmptyDIFactory;

class AbstractFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Container\AbstractFactory
     * @group specification
     */
    public function testRegisterDefinitionEmptyId()
    {
        $pFactory = new EmptyDIFactory();
        $this->expectException(\InvalidArgumentException::class);
        $pFactory->registerDefinition('   ', []);
    }

    /**
     * @covers \Pbraiders\Container\AbstractFactory
     * @group specification
     */
    public function testRegisterDefinition()
    {
        $pFactory = new EmptyDIFactory();
        $pFactory->registerDefinition('settings', ['un' => new \stdClass]);
        $this->expectException(\InvalidArgumentException::class);
        $pFactory->registerDefinition('settings', ['deux' => new \stdClass]);
    }
}
