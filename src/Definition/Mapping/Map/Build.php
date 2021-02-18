<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\MappingOrScalarSequence;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;

class Build
{
    /**
     *
     * @return BuildDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'context' => Scalar::class,
                'dockerfile' => Scalar::class,
                'args' => MappingOrScalarSequence::class,
                'cache_from' => ScalarSequence::class,
                'labels' => MappingOrScalarSequence::class,
                'shm_size' => Scalar::class,
                'target' => Scalar::class,
            ],
        ];
    }
}
