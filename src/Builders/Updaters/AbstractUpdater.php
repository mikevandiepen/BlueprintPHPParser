<?php

namespace Blueprint\Builders\Updaters;

use ReflectionClass;
use PhpParser\ParserFactory;

abstract class AbstractUpdater
{
    /**
     * @var \PhpParser\Node\Stmt[]|null
     */
    private $existingClass;
    private $changeLog = [];

    /**
     * AbstractUpdater constructor.
     *
     * Collects the file contents using the FullyQualifiedClassName and
     * using the content to prepare PHP-Parser.
     *
     * @param string $fullyQualifiedClassName
     *
     * @throws \ReflectionException
     */
    public function __construct(string $fullyQualifiedClassName)
    {
        $reflectionClass = new ReflectionClass($fullyQualifiedClassName);
        $fileContent = file_get_contents($reflectionClass->getFileName());
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $this->existingClass = $parser->parse($fileContent);
    }

    /**
     * Collecting the abstract syntax tree of the existing class.
     *
     * @return \PhpParser\Node\Stmt[]|null
     */
    public function getExistingClass()
    {
        return $this->existingClass;
    }
}