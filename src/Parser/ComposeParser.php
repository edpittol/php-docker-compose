<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Parser;

use Aztec\DockerCompose\Builder\BuilderInterface;
use Aztec\DockerCompose\Compose;
use Aztec\DockerCompose\Definition\DefinitionFactoryInterface;

/**
 * Parse Compose root definitions
 */
class ComposeParser
{
    /**
     * The builder to build the parser data
     *
     * @var BuilderInterface
     */
    private $builder;

    /**
     * The factory to create the definitions
     *
     * @var DefinitionFactoryInterface
     */
    private $definitionFactory;

    /**
     * Constructor
     *
     * @param BuilderInterface           $builder
     * @param DefinitionFactoryInterface $definitionFactory
     */
    public function __construct(BuilderInterface $builder, DefinitionFactoryInterface $definitionFactory)
    {
        $this->builder = $builder;
        $this->definitionFactory = $definitionFactory;
    }

    /**
     * Parse an array to Compose definition objects
     *
     * @param  array<string, array<string, array<string, string>>|string> $data
     * @return Compose
     */
    public function parse(array $data): Compose
    {
        foreach ($data as $name => $definition) {
            $definition = $this->definitionFactory->create([$name], $definition);
            $this->builder->add($definition);
        }

        return $this->builder->builtObject();
    }
}
