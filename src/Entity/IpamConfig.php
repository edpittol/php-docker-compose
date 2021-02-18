<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class IpamConfig implements EntityInterface
{
    private string $subnet;

    public function __construct(string $subnet)
    {
        $this->subnet = $subnet;
    }

    public function getSubnet(): string
    {
        return $this->subnet;
    }
}
