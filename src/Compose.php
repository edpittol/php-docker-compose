<?php

declare(strict_types=1);

namespace Aztec\DockerCompose;

use Aztec\DockerCompose\Definition\Node;

class Compose
{
    private Node $definition;

    public function __construct()
    {
        $this->definition = new Node('compose');
    }

    public function getDefinition(): Node
    {
        return $this->definition;
    }
}
