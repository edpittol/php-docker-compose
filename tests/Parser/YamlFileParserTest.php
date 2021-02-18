<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Tests\Parser;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Aztec\DockerCompose\Parser\YamlFileParser;

/**
 * Parse Compose root definitions
 */
final class YamlFileParserTest extends TestCase
{
    private YamlFileParser $parser;

    /**
     * @var string
     */
    private $yamlContent = <<<EOT
version: x

services:
  foo:
    image: alpine
EOT;

    /**
     * @var array<string, array<string, array<string, string>>|string>
     */
    private $parsedData = [
        'version' => 'x',
        'services' => [
            'foo' => [
                'image' => 'alpine'
            ]
        ]
    ];

    public function setUp(): void
    {
        $this->parser = new YamlFileParser();
    }

    public function testParse(): void
    {
        $root = vfsStream::setup();

        $file = vfsStream::newFile('docker-compose.yml')
            ->at($root)
            ->setContent($this->yamlContent);

        $this->assertEquals($this->parsedData, $this->parser->parse($file->url()));
    }
}
