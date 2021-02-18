<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

/**
 * Represents a node that contains nominables definitions
 *
 * It represents services, volumes, networks...
 */
class Name extends Collection implements DefinitionInterface
{
    /**
     * The definition list
     *
     * @var array<string, array<DefinitionInterface>>
     */
    protected $definitions;

    /**
     * Add a new named definition list
     *
     * @param string $key
     * @param array<int, DefinitionInterface> $definitions
     * @return void
     */
    public function add(string $key, array $definitions)
    {
        $this->definitions[$key] = $definitions;
    }
}
