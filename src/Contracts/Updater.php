<?php

namespace Blueprint\Contracts;

interface Updater
{
    public function process(): void;
}