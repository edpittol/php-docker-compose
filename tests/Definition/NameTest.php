<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Definition\Name;
use Aztec\DockerCompose\Definition\Basic;
use Aztec\DockerCompose\Definition\Node;

final class NameTest extends TestCase
{
    private Name $definition;

    protected function setUp(): void
    {
        $this->definition = new Name('foo');
    }

    public function testAdd(): void
    {
        $this->definition->add('foo', [new Node('bar')]);

        $definitions = $this->definition->getDefinitions();
        assert(is_array($definitions['foo']));

        $fooDefinition = $definitions['foo'][0];

        $this->assertEquals('bar', $fooDefinition->getName());
    }

    public function testGetDefinitions(): void
    {
        $this->definition->add('foo', [new Node('bar')]);

        $this->assertCount(1, $this->definition->getDefinitions());
    }

    public function testGetName(): void
    {
        $this->assertEquals('foo', $this->definition->getName());
    }
}
