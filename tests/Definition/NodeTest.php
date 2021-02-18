<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Definition\Node;
use Aztec\DockerCompose\Definition\Basic;

final class NodeTest extends TestCase
{
    /**
     * @var Node
     */
    private $definition;

    protected function setUp(): void
    {
        $this->definition = new Node('foo');
    }

    public function testAdd(): void
    {
        $this->definition->add(new Basic('bar'));

        $definition = $this->definition->getDefinitions()[0];
        assert($definition instanceof Basic);

        $this->assertEquals('bar', $definition->getName());
    }

    public function testGetDefinitions(): void
    {
        $this->definition->add(new Basic('bar'));

        $this->assertCount(1, $this->definition->getDefinitions());
    }

    public function testGetName(): void
    {
        $this->assertEquals('foo', $this->definition->getName());
    }
}
