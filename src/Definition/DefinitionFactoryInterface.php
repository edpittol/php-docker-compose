<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

interface DefinitionFactoryInterface
{
    /**
     * Create a definition
     *
     * @param array<string> $contextPath
     * @param string|array<int, string>|array<string, array<string, array<int, string>|string>> $value
     * @return DefinitionInterface
     */
    public function create(array $contextPath, $value): DefinitionInterface;
}
