<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class Volume implements EntityInterface
{
    private string $type;
    private ?string $source;
    private string $target;
    private bool $readOnly;

    /**
     *
     * @var array<string> bind
     */
    private ?array $bind;

    /**
     *
     * @var array<string> volume
     */
    private ?array $volume;

    /**
     *
     * @var array<string>|null tmpfs
     */
    private ?array $tmpfs;

    private ?string $consistency;

    /**
     * Undocumented function
     *
     * @param string $type
     * @param string|null $source
     * @param string $target
     * @param boolean $readOnly
     * @param array<string>|null $bind
     * @param array<string>|null $volume
     * @param array<string>|null $tmpfs
     * @param string|null $consistency
     */
    public function __construct(
        string $type,
        ?string $source,
        string $target,
        bool $readOnly,
        ?array $bind,
        ?array $volume,
        ?array $tmpfs,
        ?string $consistency
    ) {
        $this->type = $type;
        $this->source = $source;
        $this->target = $target;
        $this->readOnly = $readOnly;
        $this->bind = $bind;
        $this->volume = $volume;
        $this->tmpfs = $tmpfs;
        $this->consistency = $consistency;
    }

    /**
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     *
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     *
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     *
     * @return boolean
     */
    public function getReadOnly(): bool
    {
        return $this->readOnly;
    }

    /**
     *
     * @return array<string>|null
     */
    public function getBind(): ?array
    {
        return $this->bind;
    }

    /**
     *
     * @return array<string>|null
     */
    public function getVolume(): ?array
    {
        return $this->volume;
    }

    /**
     *
     * @return array<string>|null
     */
    public function getTmpfs(): ?array
    {
        return $this->tmpfs;
    }

    /**
     *
     * @return string|null
     */
    public function getConsistency(): ?string
    {
        return $this->consistency;
    }
}
