<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\Scalar;

class CredentialSpecs
{
    /**
     *
     * @return CredentialSpecsDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'file' => Scalar::class,
                'registry' => Scalar::class
            ],
        ];
    }
}
