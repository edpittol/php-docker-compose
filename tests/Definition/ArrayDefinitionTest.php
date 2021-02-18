<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Definition\ArrayDefinition;
use Aztec\DockerCompose\Entity\Basic;

final class ArrayDefinitionTest extends TestCase
{
    private ArrayDefinition $definition;

    protected function setUp(): void
    {
        $this->definition = new ArrayDefinition('foo');
    }

    public function testAdd(): void
    {
        $this->definition->add(new Basic('bar'));

        $entity = $this->definition->getEntities()[0];
        assert($entity instanceof Basic);

        $this->assertEquals('bar', $entity->getValue());
    }

    public function testGetEntities(): void
    {
        $this->definition->add(new Basic('bar'));

        $this->assertCount(1, $this->definition->getEntities());
    }

    public function testGetName(): void
    {
        $this->assertEquals('foo', $this->definition->getName());
    }
}
