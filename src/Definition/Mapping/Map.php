<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping;

use Aztec\DockerCompose\Definition\Mapping\Map\Compose;

class Map implements MapInterface
{
    private MapLeafStep $step;

    /**
     * @var array<string>
     */
    private array $path;

    public function __construct()
    {
        $this->step = new MapLeafStep();
        $this->path = [];
    }

    public function getStepName(): ?string
    {
        return $this->step->getName();
    }

    /**
     *
     * @return class-string|null
     */
    public function getStepClass(): ?string
    {
        return $this->step->getClass();
    }

    /**
     *
     * @return array<string>
     */
    public function getPath(): array
    {
        return $this->path;
    }

    public function path(array $contextPath): void
    {
        $this->path = $contextPath;
        $map = $this->map();

        $stepDefiner = new StepDefiner($contextPath, $map);
        $this->step = $stepDefiner->define();
    }

    /**
     *
     * @return ComposeDefinition
     */
    private function map(): array
    {
        return Compose::map();
    }
}
