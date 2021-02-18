<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\Scalar;

class Ulimits
{
    /**
     *
     * @return UlimitsDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'nproc' => Scalar::class,
                'nofile' => self::ulimitsNofile(),
            ],
        ];
    }

    /**
     *
     * @return UlimitsNofileDefinition
     */
    public static function ulimitsNofile(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'soft' => Scalar::class,
                'hard' => Scalar::class,
            ],
        ];
    }
}
