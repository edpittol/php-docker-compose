<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Definition\Basic;
use Aztec\DockerCompose\Entity\Basic as BasicEntity;

final class BasicTest extends TestCase
{
    private Basic $definition;

    protected function setUp(): void
    {
        $this->definition = new Basic('foo');
    }

    public function testDefineEntity(): void
    {
        $entity = new BasicEntity('bar');

        $this->definition->defineEntity($entity);
        $definitionEntity = $this->definition->getEntity();
        assert($definitionEntity instanceof BasicEntity);

        $this->assertEquals('bar', $definitionEntity->getValue());
    }

    public function testGetName(): void
    {
        $this->assertEquals('foo', $this->definition->getName());
    }
}
