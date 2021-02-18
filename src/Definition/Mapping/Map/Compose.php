<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Entity\Transformer\Scalar;

class Compose
{
    /**
     *
     * @return ComposeDefinition
     */
    public static function map(): array
    {
        return [
            'version' => Scalar::class,
            'services' => Services::map(),
            'volumes' => Driver::map(),
            'networks' => Driver::map(),
            'configs' => File::map(),
            'secrets' => File::map(),
        ];
    }
}
