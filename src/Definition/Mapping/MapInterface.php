<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping;

interface MapInterface
{

    public function getStepName(): ?string;

    public function getStepClass(): ?string;

    /**
     *
     * @return array<string>
     */
    public function getPath(): array;

    /**
     *
     * @param array<string> $contextPath
     */
    public function path(array $contextPath): void;
}
