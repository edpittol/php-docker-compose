<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Builder;

use Aztec\DockerCompose\Compose;
use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;

class Builder implements BuilderInterface
{
    private Compose $built;

    private MapInterface $map;

    /**
     * Create a builder from a Compose object
     */
    public function __construct(MapInterface $map)
    {
        $this->built = new Compose();
        $this->map = $map;
    }

    public function getMap(): MapInterface
    {
        return $this->map;
    }

    /**
     * {@inheritDoc}
     */
    public function add(DefinitionInterface $definition): void
    {
        $composeDefinitions = $this->built->getDefinition();
        $composeDefinitions->add($definition);
    }

    /**
     * {@inheritDoc}
     */
    public function builtObject(): Compose
    {
        return $this->built;
    }
}
