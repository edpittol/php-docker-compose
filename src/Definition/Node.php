<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

/**
 * Represents a node inner the compose definition tree
 */
class Node extends Collection
{
    /**
     * Add a new definition to the node
     *
     * @param DefinitionInterface $definition
     * @return void
     */
    public function add(DefinitionInterface $definition): void
    {
        $this->definitions[] = $definition;
    }
}
