<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Name;
use Aztec\DockerCompose\Entity\Transformer\Scalar;

class File
{
    /**
     *
     * @return FileDefinition
     */
    public static function map(): array
    {
        /**
         *
         * @return FileDefinition
         */
        return [
            'definition' => Name::class,
            'children' => [
                'file' => Scalar::class,
                'external' => Scalar::class,
                'name' => Scalar::class,
            ],
        ];
    }
}
