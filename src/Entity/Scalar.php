<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Entity;

class Scalar implements EntityInterface
{
    /**
     *
     * @var mixed
     */
    protected $value;

    /**
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
