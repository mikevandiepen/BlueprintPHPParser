<?php

namespace Blueprint;

use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;

final class Changelog
{
    private const CHANGELOG_FILE_NAME = '.blueprint.yaml';

    private static $changelog = [];

    /**
     * Adding a log item to the changelog.
     *
     * @param string $type
     * @param string $description
     *
     * @return void
     */
    public static function add(string $type, string $description): void
    {
        self::$changelog[$type][] = $description;
    }

    /**
     * Generating a changelog file.
     *
     * @return void
     */
    public function generate(): void
    {
        file_put_contents(self::CHANGELOG_FILE_NAME, Yaml::dump(self::$changelog));
    }
}