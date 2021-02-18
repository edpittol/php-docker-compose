<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Node;
use Aztec\DockerCompose\Entity\Transformer\Mapping;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;

class Deploy
{
    /**
     *
     * @return DeployDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Node::class,
            'children' => [
                'endpoint_mode' => Scalar::class,
                'labels' => Mapping::class,
                'mode' => Scalar::class,
                'placement' => self::placement(),
                'replicas' => Scalar::class,
                'max_replicas_per_node' => Scalar::class,
                'resources' => self::resources(),
                'restart_policy' => self::restartPolicy(),
                'rollback_config' => self::deployConfig(),
                'update_config' => self::deployConfig(),
            ],
        ];
    }

    /**
     *
     * @return PlacementDefinition
     */
    public static function placement()
    {
        return [
            'definition' => Node::class,
            'children' => [
                'constraints' => ScalarSequence::class,
                'preferences' => Scalar::class,
            ],
        ];
    }

    /**
     *
     * @return ResourcesDefinition
     */
    public static function resources()
    {
        return [
            'definition' => Node::class,
            'children' => [
                'limits' => self::resourcesData(),
                'reservations' => self::resourcesData(),
            ],
        ];
    }

    /**
     *
     * @return ResourcesDataDefinition
     */
    public static function resourcesData()
    {
        return [
            'definition' => Node::class,
            'children' => [
                'cpus' => Scalar::class,
                'memory' => Scalar::class,
            ],
        ];
    }

    /**
     *
     * @return RestartPolicyDefinition
     */
    public static function restartPolicy()
    {
        return [
            'definition' => Node::class,
            'children' => [
                'condition' => Scalar::class,
                'delay' => Scalar::class,
                'max_attempts' => Scalar::class,
                'window' => Scalar::class,
            ],
        ];
    }

    /**
     *
     * @return DeployConfigDefinition
     */
    public static function deployConfig()
    {
        return [
            'definition' => Node::class,
            'children' => [
                'parallelism' => Scalar::class,
                'delay' => Scalar::class,
                'failure_action' => Scalar::class,
                'monitor' => Scalar::class,
                'max_failure_ratio' => Scalar::class,
                'order' => Scalar::class,
            ],
        ];
    }
}
