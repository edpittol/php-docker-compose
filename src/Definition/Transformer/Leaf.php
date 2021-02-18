<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Leaf as LeafDefinition;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;
use Aztec\DockerCompose\Entity\Transformer\EntityTransformerInterface;
use Exception;

/**
 * Transforms leaf definitions
 */
class Leaf implements DefinitionTransformerInterface
{
    /**
     * The transformer for the compose file definition value
     *
     * @var EntityTransformerInterface
     */
    protected EntityTransformerInterface $entityTransformer;

    /**
     * Constructor
     *
     * @param EntityTransformerInterface $entityTransformer
     */
    public function __construct(EntityTransformerInterface $entityTransformer)
    {
        $this->entityTransformer = $entityTransformer;
    }

    /**
     *
     * @param  MapInterface $map
     * @param  mixed $value
     * @return DefinitionInterface
     */
    public function fromComposeFile(MapInterface $map, $value): DefinitionInterface
    {
        $name = $map->getStepName();
        assert(is_string($name));
        $definition = new LeafDefinition($name);

        $entity = $this->entityTransformer->fromComposeFile($value);
        $definition->defineEntity($entity);

        return $definition;
    }
}
