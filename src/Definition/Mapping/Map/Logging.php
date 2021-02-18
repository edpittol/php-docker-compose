<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\Scalar;

class Logging
{
    /**
     *
     * @return LoggingDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'driver' => Scalar::class,
                'options' => self::loggingOptions(),
            ],
        ];
    }

    /**
     *
     * @return LoggingOptionsDefinition
     */
    public static function loggingOptions(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'syslog-address' => Scalar::class,
                'max-size' => Scalar::class,
                'max-file' => Scalar::class,
            ],
        ];
    }
}
