<?php

namespace Blueprint\Contracts;

interface Determiner
{
    /**
     * Determines whether the subject class should be generated or updated.
     *
     * @return array|null
     */
    public function handle(): ?array;
}