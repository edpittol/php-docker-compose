<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping;

use Aztec\DockerCompose\Definition\Transformer\Name;
use Aztec\DockerCompose\Definition\Transformer\NameOrScalarSequence;
use Aztec\DockerCompose\Entity\Transformer\MappingOrScalarSequence;
use Aztec\DockerCompose\Exception\NotSupportedException;

class StepDefiner
{
    /**
     *
     * @var array<string>
     */
    private array $contextPath;

    /**
     *
     * @var ComposeDefinition
     */
    private array $map;

    private MapLeafStep $step;

    /**
     *
     * @param array<string>      $contextPath
     * @param ComposeDefinition $map
     */
    public function __construct(array $contextPath, array $map)
    {
        $this->contextPath = $contextPath;
        $this->map = $map;
        $this->step = new MapLeafStep();
    }

    /**
     *
     * @return MapLeafStep
     */
    public function define(): MapLeafStep
    {
        return $this->defineRecursively($this->map);
    }

    /**
     *
     * @param ComposeDefinition|ChildrenList $map
     * @return MapLeafStep
     */
    private function defineRecursively(array $map): MapLeafStep
    {
        $stop = $this->nextStep($map);

        if ($stop) {
            return $this->step;
        }

        $step = $this->step->getName();
        assert(is_array($map[$step]));
        assert(key_exists('children', $map[$step]));
        return $this->defineRecursively($map[$step]['children']);
    }

    /**
     *
     * @param  ComposeDefinition|ChildrenList $map
     * @return bool
     */
    private function nextStep(array $map): bool
    {
        $step = current($this->contextPath);

        $step = $this->currentDefinition($map, $step);
        if (is_null($step)) {
            return true;
        }

        $definition = $this->stepDefinition($map, $step);
        $this->defineStep($step, $definition);

        $stop = next($this->contextPath) === false;
        return $stop;
    }

    /**
     *
     * @param  ComposeDefinition|ChildrenList $map
     * @param  string                                       $step
     * @return string|null
     */
    private function currentDefinition(array $map, string $step): ?string
    {
        $currentDefinition = $this->step->getClass();

        if ($this->namedStep($currentDefinition)) {
            $step = next($this->contextPath);
        }

        if (in_array($currentDefinition, [MappingOrScalarSequence::class, NameOrScalarSequence::class], true)) {
            $this->defineStep($step, $currentDefinition);
            return null;
        }

        if (!key_exists($step, $map)) {
            throw new NotSupportedException(
                sprintf('Mapping is not supported (%s).', implode('/', $this->contextPath))
            );
        }

        return $step ?? null;
    }

    /**
     *
     * @param  string       $step
     * @param  class-string $class
     * @return void
     */
    private function defineStep(string $step, string $class): void
    {
        $this->step->defineStep($step, $class);
    }

    /**
     *
     * @param  string|null $currentDefinition
     * @return bool
     */
    private function namedStep(?string $currentDefinition): bool
    {
        $isNamed = in_array($currentDefinition, [Name::class], true);
        return $isNamed;
    }

    /**
     *
     * @param  ComposeDefinition|ChildrenList $map
     * @param  string                                       $step
     * @return class-string
     */
    private function stepDefinition(array $map, string $step): string
    {
        if (!isset($map[$step])) {
            assert(is_string($this->step->getClass()));
            assert(class_exists($this->step->getClass()));
            return $this->step->getClass();
        }

        if (is_string($map[$step])) {
            assert(class_exists($map[$step]));
            return $map[$step];
        }

        return $map[$step]['definition'];
    }
}
