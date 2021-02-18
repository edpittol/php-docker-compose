<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class Port implements EntityInterface
{
    private string $target;
    private string $published;
    private string $protocol;
    private string $mode;

    public function __construct(string $target, string $published = '', string $protocol = '', string $mode = '')
    {
        $this->target = $target;
        $this->published = $published;
        $this->protocol = $protocol;
        $this->mode = $mode;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getPublished(): string
    {
        return $this->published;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}
