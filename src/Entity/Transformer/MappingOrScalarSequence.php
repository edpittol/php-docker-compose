<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;

/**
 * Transforms leaf definitions
 */
class MappingOrScalarSequence implements EntityTransformerInterface
{
    /**
     *
     * @param  mixed $value
     * @return EntityInterface
     */
    public function fromComposeFile($value): EntityInterface
    {
        if (is_string(key($value))) {
            return $this->mapping($value);
        }

        return $this->scalarSequence($value);
    }

    /**
     *
     * @param array<string, string> $value
     * @return EntityInterface
     */
    private function mapping(array $value): EntityInterface
    {
        $transformer = new Mapping();
        return $transformer->fromComposeFile($value);
    }

    /**
     *
     * @param array<int, string> $value
     * @return EntityInterface
     */
    private function scalarSequence(array $value): EntityInterface
    {
        $transformer = new ScalarSequence();
        return $transformer->fromComposeFile($value);
    }
}
