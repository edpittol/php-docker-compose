<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\NameOrScalarSequence;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;

class ServiceNetworks
{
    /**
     *
     * @return ServiceNetworksDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => NameOrScalarSequence::class,
            'children' => [
                'aliases' => ScalarSequence::class,
                'ipv4_address' => Scalar::class,
                'ipv6_address' => Scalar::class,
            ],
        ];
    }
}
