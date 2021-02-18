<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class ContainerFile implements EntityInterface
{
    private string $source;
    private string $target;
    private string $uid;
    private string $gid;
    private int $mode;

    public function __construct(
        string $source = '',
        string $target = '',
        string $uid = '',
        string $gid = '',
        int $mode = 0
    ) {
        $this->source = $source;
        $this->target = $target;
        $this->uid = $uid;
        $this->gid = $gid;
        $this->mode = $mode;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getGid(): string
    {
        return $this->gid;
    }

    public function getMode(): int
    {
        return $this->mode;
    }
}
