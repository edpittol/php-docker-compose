<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

/**
 * Represents a definition which has a collection of other definitions
 */
abstract class Collection extends Definition
{
    /**
     * The definition list
     *
     * @var array<int|string, DefinitionInterface>
     */
    protected $definitions = [];

    /**
     * Get the definition list
     *
     * @return array<int|string, DefinitionInterface>
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }
}
