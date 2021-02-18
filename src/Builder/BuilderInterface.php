<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Builder;

use Aztec\DockerCompose\Compose;
use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;

/**
 * Compose builder
 */
interface BuilderInterface
{
    public function getMap(): MapInterface;

    /**
     * Add a new definition to the built object
     *
     * @param DefinitionInterface $definition
     * @return void
     */
    public function add(DefinitionInterface $definition): void;

    /**
     * Get the built object
     *
     * @return Compose
     */
    public function builtObject(): Compose;
}
