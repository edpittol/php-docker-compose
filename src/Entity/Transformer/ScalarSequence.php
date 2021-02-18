<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Scalar;
use Aztec\DockerCompose\Entity\Sequence;

class ScalarSequence implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        $entity = new Sequence();
        foreach ($value as $val) {
            $scalarEntity = new Scalar($val);
            $entity->add($scalarEntity);
        }

        return $entity;
    }
}
