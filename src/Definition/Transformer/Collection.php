<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\DefinitionFactoryInterface;

/**
 * Transforms collection definitions
 */
abstract class Collection
{
    protected DefinitionFactoryInterface $factory;

    /**
     * Constructor
     *
     * @param DefinitionFactoryInterface $factory
     */
    public function __construct(DefinitionFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
}
