<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\Definition;
use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;
use Aztec\DockerCompose\Definition\Node as NodeDefinition;

/**
 * Transforms to a Node
 */
class Node extends Collection implements DefinitionTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile(MapInterface $map, $nodeList): DefinitionInterface
    {
        $name = $map->getStepName();
        assert(is_string($name));
        $nodeDefinition = new NodeDefinition($name);
        $basePath = $map->getPath();
        foreach ($nodeList as $definitionName => $definitionValue) {
            $definitionPath = array_merge($basePath, [$definitionName]);
            $definition = $this->factory->create($definitionPath, $definitionValue);
            assert($definition instanceof Definition);
            $nodeDefinition->add($definition);
        }

        return $nodeDefinition;
    }
}
