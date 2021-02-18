<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Leaf as LeafDefinition;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;
use Aztec\DockerCompose\Definition\Name as NameDefinition;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;

/**
 * Transforms leaf definitions
 */
class NameOrScalarSequence extends Collection implements DefinitionTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile(MapInterface $map, $value): DefinitionInterface
    {
        if (is_string(key($value))) {
            return $this->name($map, $value);
        }

        return $this->leaf($map, $value);
    }

    /**
     *
     * @param  MapInterface $map
     * @param  string $value
     * @return LeafDefinition
     */
    private function leaf(MapInterface $map, $value): LeafDefinition
    {
        $entityTransformer = new ScalarSequence();
        $transformer = new Leaf($entityTransformer);
        $definition = $transformer->fromComposeFile($map, $value);

        assert(is_a($definition, LeafDefinition::class));
        return $definition;
    }

    /**
     *
     * @param  MapInterface $map
     * @param  array<string,string> $value
     * @return NameDefinition
     */
    private function name(MapInterface $map, $value): NameDefinition
    {
        $transformer = new Name($this->factory);
        $definition = $transformer->fromComposeFile($map, $value);

        assert(is_a($definition, NameDefinition::class));
        return $definition;
    }
}
