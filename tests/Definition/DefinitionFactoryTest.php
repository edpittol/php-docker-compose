<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Exception\NotSupportedException;
use Aztec\DockerCompose\Builder\Builder;
use Aztec\DockerCompose\Definition\ArrayDefinition;
use Aztec\DockerCompose\Definition\Basic;
use Aztec\DockerCompose\Definition\DefinitionFactory;
use Aztec\DockerCompose\Definition\Map;
use Aztec\DockerCompose\Definition\Name;
use Aztec\DockerCompose\Definition\Node;
use Aztec\DockerCompose\Entity\Basic as BasicEntity;
use Aztec\DockerCompose\Entity\Port;
use Webmozart\Assert\Assert;

final class DefinitionFactoryTest extends TestCase
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * @var DefinitionFactory
     */
    private $factory;

    protected function setUp(): void
    {
        $map = new Map();
        $this->builder = new Builder($map);
        $this->factory = new DefinitionFactory($this->builder);
    }

    public function testCreateUnsupportedType(): void
    {
        $this->expectException(NotSupportedException::class);

        $this->factory->create(['services', 'foo'], 'bar');
    }

    public function testCreateArrayDefinition(): void
    {
        $definition = $this->factory->create(['services', 'foo', 'environment'], ['foo']);

        $this->assertInstanceOf(ArrayDefinition::class, $definition);
    }

    public function testCreateNameDefinition(): void
    {
        $definition = $this->factory->create(
            ['services'],
            [
                'service' => [
                    'image' => 'foo',
                    'env_file' => [
                        'bar'
                    ]
                ]
            ]
        );
        assert($definition instanceof Name);

        $this->assertInstanceOf(Name::class, $definition);
    }

    public function testCreateNodeDefinition(): void
    {
        $definition = $this->factory->create(['services', 'foo', 'build'], ['context' => '.']);
        assert($definition instanceof Node);

        $this->assertInstanceOf(Node::class, $definition);
    }

    public function testCreateBasicDefinition(): void
    {
        $definition = $this->factory->create(['version'], 'x');

        $this->assertInstanceOf(Basic::class, $definition);
    }

    public function testCreateBasicEntity(): void
    {
        $definition = $this->factory->create(['version'], 'x');
        assert($definition instanceof Basic);

        $this->assertInstanceOf(BasicEntity::class, $definition->getEntity());
    }

    public function testCreatePortEntity(): void
    {
        $definition = $this->factory->create(['services', 'foo', 'ports'], ['1']);
        assert($definition instanceof ArrayDefinition);

        $this->assertContainsOnlyInstancesOf(Port::class, $definition->getEntities());
    }
}
