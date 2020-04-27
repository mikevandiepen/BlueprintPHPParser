<?php

namespace Blueprint\Builders;

abstract class AbstractDeterminer
{
    protected const GENERATOR   = 1;
    protected const UPDATER     = 2;

    protected $fullyQualifiedClassName;

    /**
     * AbstractDeterminer constructor.
     *
     * @param string $fullyQualifiedClassName
     */
    public function __construct(string $fullyQualifiedClassName)
    {
        $this->fullyQualifiedClassName = $fullyQualifiedClassName;
    }

    /**
     * Determines whether the subject class must be generated or updated.
     *
     * Return options:
     * 1 - Generate a new class.
     * 2 - Update existing class.
     *
     * @return int
     */
    protected function determine(): int
    {
        return (int) (class_exists($this->fullyQualifiedClassName)) ? 1 : 2;
    }
}