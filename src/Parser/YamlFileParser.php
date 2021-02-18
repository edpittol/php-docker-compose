<?php

declare(strict_types=1);

namespace Aztec\DockerCompose\Parser;

use Symfony\Component\Yaml\Yaml;

/**
 * YAML file parser
 */
class YamlFileParser
{
    /**
     * Parse a YAML file from its name to array
     *
     * @param string $filename
     * @return array<string, string>
     */
    public function parse(string $filename): array
    {
        return Yaml::parseFile($filename);
    }
}
