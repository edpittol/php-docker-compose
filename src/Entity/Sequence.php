<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

/**
 * @template T
 */
class Sequence implements EntityInterface
{
    /**
     *
     * @var array<T>
     */
    private array $entities;

    /**
     *
     * @param T $entity
     */
    public function add($entity): void
    {
        $this->entities[] = $entity;
    }

    /**
     *
     * @return array<T>
     */
    public function getValue(): array
    {
        return $this->entities;
    }
}
