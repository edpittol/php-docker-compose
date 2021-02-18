<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Definition\Name;
use Aztec\DockerCompose\Definition\DefinitionFactoryInterface;
use Aztec\DockerCompose\Definition\Name as NameDefinition;

/**
 * Parse Compose root definitions
 */
final class NameTest extends TestCase
{
    private Name $transformer;

    public function setUp(): void
    {
        $definitionTransformer = $this->createMock(DefinitionFactoryInterface::class);
        $this->transformer = new Name($definitionTransformer);
    }

    public function testFromComposeFile(): void
    {
        $definition = $this->transformer->fromComposeFile(['foo'], ['bar' => ['baz' => 'inga']]);
        assert($definition instanceof NameDefinition);

        $this->assertInstanceOf(NameDefinition::class, $definition);
    }
}
