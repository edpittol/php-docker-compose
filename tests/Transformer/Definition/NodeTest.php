<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Definition;

use Aztec\DockerCompose\Definition\Basic;
use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Definition\Node;
use Aztec\DockerCompose\Definition\DefinitionFactoryInterface;
use Aztec\DockerCompose\Definition\Node as NodeDefinition;

/**
 * Parse Compose root definitions
 */
final class NodeTest extends TestCase
{
    private Node $transformer;

    public function setUp(): void
    {
        $definitionTransformer = $this->createMock(DefinitionFactoryInterface::class);

        // phpcs:disable ObjectCalisthenics.CodeAnalysis.OneObjectOperatorPerLine
        $definitionTransformer->method('create')
            ->willReturn(new Basic('foo'));
        // phpcs:enable

        $this->transformer = new Node($definitionTransformer);
    }

    public function testFromComposeFile(): void
    {
        $definition = $this->transformer->fromComposeFile(['foo'], ['bar' => 'baz']);

        $this->assertInstanceOf(NodeDefinition::class, $definition);
    }
}
