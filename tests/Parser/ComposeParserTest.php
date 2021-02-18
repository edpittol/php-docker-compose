<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Parser;

use PHPUnit\Framework\TestCase;
use Aztec\DockerCompose\Parser\ComposeParser;
use Aztec\DockerCompose\Builder\Builder;
use Aztec\DockerCompose\Compose;
use Aztec\DockerCompose\Definition\Basic;
use Aztec\DockerCompose\Definition\DefinitionFactory;
use Aztec\DockerCompose\Definition\Map;
use Aztec\DockerCompose\Definition\Name;
use Aztec\DockerCompose\Entity\Basic as EntityBasic;

/**
 * Parse Compose root definitions
 */
final class ComposeParserTest extends TestCase
{
    /**
     * @var array<string, array<string, array<string, string>>|string>
     */
    private $data = [
        'version' => 'x',
        'services' => [
            'foo' => [
                'image' => 'alpine'
            ]
        ]
    ];

    private Compose $compose;

    public function setUp(): void
    {
        $map = new Map();
        $builder = new Builder($map);
        $factory = new DefinitionFactory($builder);
        $parser = new ComposeParser($builder, $factory);

        $this->compose = $parser->parse($this->data);
    }

    public function testComposeDefinition(): void
    {
        $composeDefinition = $this->compose->getDefinition();

        $this->assertEquals('compose', $composeDefinition->getName());
    }

    public function testFirstDefinitionName(): void
    {
        $composeDefinition = $this->compose->getDefinition();
        $definitions = $composeDefinition->getDefinitions();

        $versionDefinition = $definitions[0];
        assert($versionDefinition instanceof Basic);

        $this->assertEquals('version', $versionDefinition->getName());
    }

    public function testLastDefinitionDeepValue(): void
    {
        $composeDefinition = $this->compose->getDefinition();
        $definitions = $composeDefinition->getDefinitions();
        assert($definitions[1] instanceof Name);

        $servicesDefinitions = $definitions[1]->getDefinitions();
        $fooDefinitions = $servicesDefinitions['foo'];
        assert(is_array($fooDefinitions));

        $imageDefinition = $fooDefinitions[0];
        assert($imageDefinition instanceof Basic);

        $imageEntity = $imageDefinition->getEntity();
        assert($imageEntity instanceof EntityBasic);

        $this->assertEquals('alpine', $imageEntity->getValue());
    }
}
