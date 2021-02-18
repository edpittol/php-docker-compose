<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition;

use Aztec\DockerCompose\Entity\EntityInterface;

class Leaf extends Definition
{
    /**
     *
     * @var EntityInterface
     */
    protected $entity;

    /**
     *
     * @param EntityInterface $entity
     * @return void
     */
    public function defineEntity(EntityInterface $entity)
    {
        $this->entity = $entity;
    }
}
