<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

/**
 * Compose definition base class
 */
abstract class Definition implements DefinitionInterface
{
    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
