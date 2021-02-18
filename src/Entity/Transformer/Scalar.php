<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\Scalar as ScalarEntity;
use Aztec\DockerCompose\Entity\EntityInterface;

class Scalar implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        return new ScalarEntity($value);
    }
}
