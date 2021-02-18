<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Entity\Port;

final class PortTest extends TestCase
{
    public function testGetTarget(): void
    {
        $port = new Port(0, 1);

        $this->assertEquals(0, $port->getTarget());
    }

    public function testGetPublished(): void
    {
        $port = new Port(0, 1);

        $this->assertEquals(1, $port->getPublished());
    }
}
