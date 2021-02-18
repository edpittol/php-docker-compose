<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Definition\ArrayTransformer;
use Aztec\DockerCompose\Transformer\Entity\EntityTransformerInterface;
use Aztec\DockerCompose\Definition\ArrayDefinition;

/**
 * Parse Compose root definitions
 */
final class ArrayTransformerTest extends TestCase
{
    private ArrayTransformer $transformer;

    public function setUp(): void
    {
        $entityTransformer = $this->createMock(EntityTransformerInterface::class);
        $this->transformer = new ArrayTransformer($entityTransformer);
    }

    public function testFromComposeFile(): void
    {
        $definition = $this->transformer->fromComposeFile(['foo'], ['bar', 'baz']);

        $this->assertInstanceOf(ArrayDefinition::class, $definition);
    }
}
