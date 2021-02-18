<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Entity\Basic;

final class BasicTest extends TestCase
{
    public function testGetValue(): void
    {
        $basic = new Basic('bar');

        $this->assertEquals('bar', $basic->getValue());
    }
}
