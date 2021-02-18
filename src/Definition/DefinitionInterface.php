<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

interface DefinitionInterface
{
    /**
     *
     * @return string
     */
    public function getName(): string;
}
