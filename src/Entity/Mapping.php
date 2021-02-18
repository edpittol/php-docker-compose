<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class Mapping implements EntityInterface
{
    /**
     *
     * @var array<string, string>
     */
    private array $entities;

    /**
     *
     * @param string $entity
     * @param mixed $entity
     */
    public function add(string $key, $entity): void
    {
        $this->entities[$key] = $entity;
    }

    /**
     *
     * @return array<string, mixed>
     */
    public function getValue(): array
    {
        return $this->entities;
    }
}
