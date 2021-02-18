<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping;

class MapLeafStep
{
    /**
     *
     * @var string
     */
    private ?string $name;

    /**
     *
     * @var class-string $data
     */
    private ?string $class;

    public function __construct()
    {
        $this->name = null;
        $this->class = null;
    }

    /**
     *
     * @param string $name
     * @param class-string $class
     * @return void
     */
    public function defineStep(string $name, string $class): void
    {
        $this->name = $name;
        $this->class = $class;
    }

    /**
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     *
     * @return class-string|null
     */
    public function getClass(): ?string
    {
        if (is_null($this->class)) {
            return $this->class;
        }

        assert(class_exists($this->class));
        return $this->class;
    }
}
