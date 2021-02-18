<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Builder;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Builder\Builder;
use Aztec\DockerCompose\Definition\Basic;
use Aztec\DockerCompose\Definition\Map;

final class BuilderTest extends TestCase
{

    public function testAdd(): void
    {
        $map = new Map();
        $builder = new Builder($map);
        $definition = new Basic('test');
        $builder->add($definition);
        $object = $builder->builtObject();

        $composeDefinition = $object->getDefinition();
        $testDefinition = $composeDefinition->getDefinitions()[0];
        assert($testDefinition instanceof Basic);

        $this->assertEquals('test', $testDefinition->getName());
    }
}
