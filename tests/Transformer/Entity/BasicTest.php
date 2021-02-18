<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Transformer\Entity;

use Aztec\DockerCompose\Entity\Basic as EntityBasic;
use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Transformer\Entity\Basic;

/**
 * Parse Compose root definitions
 */
final class BasicTest extends TestCase
{
    private Basic $transformer;

    public function setUp(): void
    {
        $this->transformer = new Basic();
    }

    public function testFromComposeFile(): void
    {
        $entity = $this->transformer->fromComposeFile('foo');
        assert($entity instanceof EntityBasic);

        $this->assertEquals('foo', $entity->getValue());
    }
}
