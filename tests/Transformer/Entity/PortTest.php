<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Entity;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Entity\Port;
use Aztec\DockerCompose\Exception\NotSupportedException;
use Aztec\DockerCompose\Entity\Port as PortEntity;

/**
 * Parse Compose root definitions
 */
final class PortTest extends TestCase
{
    private Port $transformer;

    public function setUp(): void
    {
        $this->transformer = new Port();
    }

    public function testFromComposeNotSupported(): void
    {
        $this->expectException(NotSupportedException::class);

        $this->transformer->fromComposeFile('1:1:1');
    }

    public function testFromComposeFileTargetAndPublished(): void
    {
        $entity = $this->transformer->fromComposeFile('1:1');
        assert($entity instanceof PortEntity);

        $this->assertEquals(1, $entity->getTarget());
        $this->assertEquals(1, $entity->getPublished());
    }

    public function testFromComposeJustTarget(): void
    {
        $entity = $this->transformer->fromComposeFile('1');
        assert($entity instanceof PortEntity);

        $this->assertEquals(1, $entity->getTarget());
        $this->assertEquals(-1, $entity->getPublished());
    }

    public function testToStringTargetAndPublished(): void
    {
        $entity = new PortEntity(1, 1);

        $this->assertEquals('1:1', $this->transformer->toString($entity));
    }

    public function testToStringJustTarget(): void
    {
        $entity = new PortEntity(1);

        $this->assertEquals('1', $this->transformer->toString($entity));
    }
}
