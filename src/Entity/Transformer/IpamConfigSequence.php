<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\IpamConfig;
use Aztec\DockerCompose\Entity\Sequence;
use Aztec\DockerCompose\Entity\Volume;

class IpamConfigSequence implements EntityTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromComposeFile($value): EntityInterface
    {
        $sequence = new Sequence();
        foreach ($value as $val) {
            $entity = $this->longSyntax($val);
            $sequence->add($entity);
        }

        return $sequence;
    }

    /**
     *
     * @param array<string, string> $value
     * @return IpamConfig
     */
    private function longSyntax($value): IpamConfig
    {
        $args = [];
        $params = [
            'subnet' => null,
        ];
        foreach ($params as $param => $default) {
            $args[] = key_exists($param, $value) ? $value[$param] : $default;
        }

        return new IpamConfig(...$args);
    }
}
