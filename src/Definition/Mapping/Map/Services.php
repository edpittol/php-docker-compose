<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Definition\Mapping\Map;

use Aztec\DockerCompose\Definition\Transformer\Name;
use Aztec\DockerCompose\Entity\Transformer\ContainerFileSequence;
use Aztec\DockerCompose\Entity\Transformer\MappingOrScalarSequence;
use Aztec\DockerCompose\Entity\Transformer\PortSequence;
use Aztec\DockerCompose\Entity\Transformer\Scalar;
use Aztec\DockerCompose\Entity\Transformer\ScalarOrSequence;
use Aztec\DockerCompose\Entity\Transformer\ScalarSequence;
use Aztec\DockerCompose\Entity\Transformer\VolumeSequence;

class Services
{

    /**
     * phpcs:disable ObjectCalisthenics.Files.FunctionLength.ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff -- The definition is so too long and does not make sense split it.
     *
     * @return ServiceDefinition
     */
    public static function map(): array
    {
        return [
            'definition' => Name::class,
            'children' => [
                'build' => Build::map(),
                'cap_add' => ScalarSequence::class,
                'cap_drop' => ScalarSequence::class,
                'cgroup_parent' => Scalar::class,
                'command' => ScalarOrSequence::class,
                'configs' => ContainerFileSequence::class,
                'container_name' => Scalar::class,
                'credential_spec' => CredentialSpecs::map(),
                'depends_on' => ScalarSequence::class,
                'deploy' => Deploy::map(),
                'devices' => ScalarSequence::class,
                'dns' => Scalar::class,
                'dns_search' => Scalar::class,
                'entrypoint' => ScalarOrSequence::class,
                'env_file' => ScalarOrSequence::class,
                'environment' => MappingOrScalarSequence::class,
                'expose' => ScalarSequence::class,
                'external_links' => Scalar::class,
                'extra_hosts' => Scalar::class,
                'healthcheck' => Healthcheck::map(),
                'image' => Scalar::class,
                'init' => Scalar::class,
                'isolation' => Scalar::class,
                'labels' => MappingOrScalarSequence::class,
                'links' => Scalar::class,
                'logging' => Logging::map(),
                'network_mode' => Scalar::class,
                'networks' => ServiceNetworks::map(),
                'pid' => Scalar::class,
                'ports' => PortSequence::class,
                'restart' => Scalar::class,
                'secrets' => ContainerFileSequence::class,
                'security_opt' => ScalarSequence::class,
                'stop_grace_period' => Scalar::class,
                'stop_signal' => Scalar::class,
                'sysctls' => ScalarSequence::class,
                'tmpfs' => ScalarOrSequence::class,
                'ulimits' => Ulimits::map(),
                'userns_mode' => Scalar::class,
                'volumes' => VolumeSequence::class,
                'working_dir' => Scalar::class,
                'user' => Scalar::class,
                'domainname' => Scalar::class,
                'hostname' => Scalar::class,
                'ipc' => Scalar::class,
                'mac_address' => Scalar::class,
                'privileged' => Scalar::class,
                'read_only' => Scalar::class,
                'shm_size' => Scalar::class,
                'stdin_open' => Scalar::class,
                'tty' => Scalar::class,
            ],
        ];
    }
    // phpcs:enable
}
