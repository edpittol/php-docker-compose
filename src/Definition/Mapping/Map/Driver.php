<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Name;
use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\IpamConfigSequence;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;

class Driver
{
    /**
     *
     * @return DriverDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Name::class,
            'children' => [
                'driver' => Scalar::class,
                'driver_opts' => ScalarSequence::class,
                'attachable' => Scalar::class,
                'ipam' => self::ipam(),
                'internal' => Scalar::class,
                'labels' => ScalarSequence::class,
                'external' => Scalar::class,
                'name' => Scalar::class,
            ]
        ];
    }

    /**
     *
     * @return IpamDefinition
     */
    public static function ipam(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'driver' => Scalar::class,
                'config' => IpamConfigSequence::class,
            ]
        ];
    }
}
