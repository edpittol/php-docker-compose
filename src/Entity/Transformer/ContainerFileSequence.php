<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\ContainerFile as ContainerFileEntity;
use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Sequence;

class ContainerFileSequence implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        $entity = new Sequence();
        foreach ($value as $val) {
            $scalarEntity = is_string($val) ? $this->shortSyntax($val) : $this->longSyntax($val);
            $entity->add($scalarEntity);
        }

        return $entity;
    }

    /**
     *
     * @param string $value
     * @return ContainerFileEntity
     */
    private function shortSyntax(string $value): ContainerFileEntity
    {
        return new ContainerFileEntity($value);
    }

    /**
     *
     * @param array<string, string> $value
     * @return ContainerFileEntity
     */
    private function longSyntax(array $value): ContainerFileEntity
    {
        $args = [];
        $params = [
            'source' => '',
            'target' => '',
            'uid' => '',
            'gid' => '',
            'mode' => 0,
        ];
        foreach ($params as $param => $default) {
            $args[] = key_exists($param, $value) ? $value[$param] : $default;
        }

        return new ContainerFileEntity(...$args);
    }
}
