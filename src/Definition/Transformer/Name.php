<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;
use Aztec\DockerCompose\Definition\Name as NameDefinition;
use Aztec\DockerCompose\Definition\Transformer\Collection;
use Aztec\DockerCompose\Exception\NotSupportedException;

/**
 * Transforms to an Name definition
 */
class Name extends Collection implements DefinitionTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile(MapInterface $map, $nodeList): DefinitionInterface
    {
        if (!is_array($nodeList)) {
            throw new NotSupportedException('Name definition should receive an array on definitions');
        }

        $name = $map->getStepName();
        assert(is_string($name));
        $pathBase = $map->getPath();

        $nameDefinition = new NameDefinition($name);
        foreach ($nodeList as $definitionName => $definitionValue) {
            $definitionPath = array_merge($pathBase, [$definitionName]);
            $nodeDefinition = $this->processNodeDefinition($definitionPath, $definitionValue);
            $nameDefinition->add($definitionName, $nodeDefinition);
        }

        return $nameDefinition;
    }

    /**
     * Process the nodes inner the named definition
     *
     * @param  array<string>         $contextPath
     * @param  array<string, string> $definitionValue
     * @return array<int, DefinitionInterface>
     */
    private function processNodeDefinition(array $contextPath, array $definitionValue): array
    {
        $definitions = [];
        foreach ($definitionValue as $name => $value) {
            $definitionPath = array_merge($contextPath, [$name]);
            $definitions[] = $this->factory->create($definitionPath, $value);
        }

        return $definitions;
    }
}
