<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

use Aztec\DockerCompose\Builder\BuilderInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;
use Aztec\DockerCompose\Definition\Transformer\DefinitionTransformerInterface;
use Aztec\DockerCompose\Definition\Transformer\Leaf as LeafTransformer;

class DefinitionFactory implements DefinitionFactoryInterface
{
    /**
     * Definition builder
     *
     * @var BuilderInterface
     */
    private $builder;

    /**
     * Constructor
     *
     * @param BuilderInterface $builder
     */
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $contextPath, $value): DefinitionInterface
    {
        $map = $this->builder->getMap();
        $map->path($contextPath);

        return $this->createDefinition($map, $value);
    }

    /**
     * Create a definition
     *
     * @param  MapInterface $map
     * @param  mixed         $value
     * @return DefinitionInterface
     */
    private function createDefinition(MapInterface $map, $value): DefinitionInterface
    {
        $stepClass = $map->getStepClass();
        assert(is_string($stepClass));
        assert(class_exists($stepClass));

        $transformer = $this->resolveTransformer($stepClass);
        return $transformer->fromComposeFile($map, $value);
    }

    /**
     * Resolve the definition transformer based on the name
     *
     * @param  string $stepClass
     * @return DefinitionTransformerInterface
     */
    private function resolveTransformer(string $stepClass): DefinitionTransformerInterface
    {
        if (preg_match('/^Aztec\\\DockerCompose\\\Definition\\\Transformer/', $stepClass) > 0) {
            return new $stepClass($this);
        }

        $entityTransformer = new $stepClass();
        return new LeafTransformer($entityTransformer);
    }
}
