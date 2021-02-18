<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;

/**
 * Transforms to a entity object
 */
interface EntityTransformerInterface
{
    /**
     * Transforms from a Compose file
     *
     * @param mixed $value
     * @return EntityInterface
     */
    public function fromComposeFile($value): EntityInterface;
}
