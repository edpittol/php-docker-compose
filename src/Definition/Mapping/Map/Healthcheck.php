<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarOrSequence;

class Healthcheck
{
    /**
     *
     * @return HealthcheckDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'test' => ScalarOrSequence::class,
                'interval' => Scalar::class,
                'timeout' => Scalar::class,
                'retries' => Scalar::class,
                'start_period' => Scalar::class,
                'disable' => Scalar::class,
            ],
        ];
    }
}
