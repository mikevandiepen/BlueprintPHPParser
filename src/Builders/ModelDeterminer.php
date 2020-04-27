<?php

namespace Blueprint\Builders;

use Blueprint\Contracts\Determiner;
use Blueprint\Builders\Updaters\ModelUpdater;
use Blueprint\Builders\Generators\ModelGenerator;

final class ModelDeterminer extends AbstractDeterminer implements Determiner
{
    /** @var \Blueprint\Models\Model $model */
    private $model;

    /**
     * Determines whether the model should be generated or updated.
     *
     * @return array|null
     * @throws \ReflectionException
     */
    public function handle(): ?array
    {
        switch ($this->determine()) {
            case self::GENERATOR:
                return ['created' => new ModelGenerator($model)];
                break;
            case self::UPDATER:
                return ['updated' => new ModelUpdater($this->fullyQualifiedClassName)];
                break;
            default:
                return null;
        }
    }

    /**
     * Setting the model configuration.
     *
     * @param \Blueprint\Models\Model $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }
}