<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Definition;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Definition\Basic;
use Aztec\DockerCompose\Transformer\Entity\EntityTransformerInterface;
use Aztec\DockerCompose\Definition\Basic as BasicDefinition;

/**
 * Parse Compose root definitions
 */
final class BasicTest extends TestCase
{
    private Basic $transformer;

    public function setUp(): void
    {
        $entityTransformer = $this->createMock(EntityTransformerInterface::class);
        $this->transformer = new Basic($entityTransformer);
    }

    public function testFromComposeFile(): void
    {
        $definition = $this->transformer->fromComposeFile(['foo'], 'bar');

        $this->assertInstanceOf(BasicDefinition::class, $definition);
    }
}
