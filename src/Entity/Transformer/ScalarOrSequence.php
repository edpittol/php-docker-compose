<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Sequence;

class ScalarOrSequence implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        if (is_string($value)) {
            $value = explode(' ', $value);
        }

        $transformer = new ScalarSequence();
        return $transformer->fromComposeFile($value);
    }
}
