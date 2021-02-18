<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Mapping as MappingEntity;

class Mapping implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        $entity = new MappingEntity();
        foreach ($value as $key => $val) {
            $entity->add($key, $val);
        }

        return $entity;
    }
}
