<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity\Transformer;

use Aztec\DockerCompose\Entity\EntityInterface;
use Aztec\DockerCompose\Entity\Sequence;
use Aztec\DockerCompose\Entity\Volume;
use Aztec\DockerCompose\Exception\NotSupportedException;

class VolumeSequence implements EntityTransformerInterface
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
     * @param  string $value
     * @return Volume
     */
    private function shortSyntax(string $value): Volume
    {
        $parts = explode(':', $value);
        $partsCount = count($parts);

        if (0 === $partsCount || 3 < $partsCount) {
            throw new NotSupportedException(sprintf('%s is not supported as volumes definition.', $value));
        }

        if ($partsCount === 1) {
            return $this->processOnePart($parts);
        }

        if ($partsCount === 2) {
            return $this->processTwoParts($parts);
        }

        return $this->processThreeParts($parts);
    }

    /**
     *
     * @param array<string> $parts
     * @return Volume
     */
    private function processOnePart($parts): Volume
    {
        $args = [
            'type' => 'volume',
            'target' => $parts[0],
        ];

        return $this->longSyntax($args);
    }

    /**
     *
     * @param array<string> $parts
     * @return Volume
     */
    private function processTwoParts($parts): Volume
    {
        $args = $this->baseArgs($parts);

        return $this->longSyntax($args);
    }

    /**
     *
     * @param array<string> $parts
     * @return Volume
     */
    private function processThreeParts($parts): Volume
    {
        $args = $this->baseArgs($parts);

        $modes = explode(',', $parts[2]);
        foreach ($modes as $mode) {
            $this->mode($mode, $args);
        }

        return $this->longSyntax($args);
    }

    /**
     *
     * @param array<string> $parts
     * @return array<string>
     */
    private function baseArgs($parts): array
    {
        return [
            'type' => preg_match('/^.?\//', $parts[0]) === 1 ? 'bind' : 'volume',
            'source' => $parts[0],
            'target' => $parts[1],
        ];
    }

    /**
     *
     * @param  string                $mode
     * @param  array<string, string> $args
     * @return void
     */
    private function mode($mode, array &$args): void
    {
        if ($mode === 'ro') {
            $args['read_only'] = true;
            return;
        }

        if ($mode === 'nocopy') {
            $args['volume'] = [
                'nocopy' => true,
            ];
            return;
        }

        if (in_array($mode, ['consistent', 'cached', 'delegated'], true)) {
            $args['consistency'] = $mode;
            return;
        }

        throw new NotSupportedException(sprintf('%s is not supported mode on volumes definition.', $mode));
    }

    /**
     * phpcs:disable ObjectCalisthenics.Files.FunctionLength.ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff -- The definition is so too long and does not make sense split it.
     *
     * @param  array<string, string|array<string, bool>> $value
     * @return Volume
     */
    private function longSyntax(array $value): Volume
    {
        $args = [];
        $params = [
            'type' => null,
            'source' => null,
            'target' => null,
            'read_only' => false,
            'bind' => [
                'propagation' => null,
            ],
            'volume' => [
                'nocopy' => null,
            ],
            'tmpfs' => [
                'size' => null,
            ],
            'consistency' => null,
        ];
        foreach ($params as $param => $default) {
            $args[] = $this->processParams($value, $default, $param);
        }

        return new Volume(...$args);
    }
    // phpcs:enable

    /**
     *
     * @param  array<string, string|array<string, bool>> $value
     * @param  array<string, null>|bool|null  $default
     * @param  string               $param
     * @return array<string, bool>|string|bool|null
     */
    private function processParams(array $value, $default, string $param)
    {
        if (!key_exists($param, $value)) {
            return is_array($default) ? [] : $default;
        }

        if (is_array($default)) {
            assert(is_array($value[$param]));
            return $this->arrayParam($value[$param], $default, $param);
        }

        return key_exists($param, $value) ? $value[$param] : $default;
    }

    /**
     *
     * @param  array<string, bool> $value
     * @param  array<string, null>  $default
     * @param  string               $param
     * @return array<string, bool>
     */
    private function arrayParam(array $value, array $default, string $param): array
    {
        $args = [];
        foreach ($default as $key => $val) {
            if (key_exists($key, $value) === false) {
                continue;
            }

            $args[$key] = $value[$key];
        }

        return $args;
    }
}
