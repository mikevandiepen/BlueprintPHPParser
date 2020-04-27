<?php

namespace Blueprint\Builders\Generators;

use PhpParser\Node\Arg;
use PhpParser\BuilderFactory;
use PhpParser\Node\Stmt\Return_;
use Blueprint\Contracts\Generator;
use PhpParser\Node\Expr\MethodCall;

final class ModelGenerator implements Generator
{
    /** @var \Blueprint\Models\Model $model */
    private $model;

    /**
     * ModelGenerator constructor.
     *
     * @param \Blueprint\Models\Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function process(): void
    {
        $factory = new BuilderFactory();

        $node = $factory->namespace('App' /* User defined namespace */)
            ->addStmt($factory->use('Illuminate\Database\Eloquent\Model'))
            ->addStmt($factory->class('User' /* User Defined model name */)->extend('Model'));

        if (true /* Determine whether the user implements traits */) {
            $node->addStmt($factory->use('Illuminate\Notifications\Notifiable' /* Trait FullyQualifiedNamespace */)->as('Notification'))
                 ->addStmt($factory->useTrait('Notification' /* Trait Classname */));
        }

        if (true /* Determine whether the user defined relationships */) {
            $relationships = [
                'hasMany' => 'post'
            ];

            foreach ($relationships as $relationship => $model) {
                $node->addStmt(
                    $factory->method($model)
                            ->setDocComment('/** ' . $relationship . ' ' . $model . ' */' /* Optional DocComment */)
                            ->setReturnType($relationship /* Optional DocComment */)
                            ->addStmt(new Return_(new MethodCall('this', $relationship, [new Arg(/* User defined namespace */ '\App\\' . $model . '::class')])))
                );
            }
        }
    }
}