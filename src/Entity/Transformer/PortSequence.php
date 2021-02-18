<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Port;
use Aztec\DockerCompose\Entity\Sequence;
use Aztec\DockerCompose\Exception\NotSupportedException;

class PortSequence implements EntityTransformerInterface
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
     * @return Port
     */
    private function shortSyntax(string $value): Port
    {
        $portProtocol = explode('/', $value);
        $port = $portProtocol[0];
        $protocol = count($portProtocol) === 2 ? $portProtocol[1] : '';

        $parts = explode(':', $port);

        $partsCount = count($parts);

        if (0 === $partsCount || 3 < $partsCount) {
            throw new NotSupportedException(sprintf('%s is not supported as ports definition.', $value));
        }

        $published = array_pop($parts);
        $target = implode(':', $parts);

        assert(is_string($published));
        return new Port($target, $published, $protocol);
    }

    /**
     *
     * @param array<string, int|string> $value
     * @return Port
     */
    private function longSyntax(array $value): Port
    {
        $args = [];
        $params = [
            'target' => '',
            'published' => '',
            'protocol' => '',
            'mode' => '',
        ];
        foreach ($params as $param => $default) {
            $args[] = key_exists($param, $value) ? (string)$value[$param] : $default;
        }

        return new Port(...$args);
    }
}
