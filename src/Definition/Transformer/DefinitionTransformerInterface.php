<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Transformer;

use Aztec\DockerCompose\Definition\DefinitionInterface;
use Aztec\DockerCompose\Definition\Mapping\MapInterface;

interface DefinitionTransformerInterface
{
    /**
     * Transforms from a Compose file
     *
     * @param MapInterface $map
     * @param mixed  $value
     * @return DefinitionInterface
     */
    public function fromComposeFile(MapInterface $map, $value): DefinitionInterface;
}
