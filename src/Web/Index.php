<?php

namespace Helloelo\Web;

use Helloelo\Api\V1;
use Yaoi\Command;
use Yaoi\Command\Application;
use Yaoi\Command\Definition;
use Yaoi\Database\Definition\Exception;

class Index extends Command
{
    /**
     * @var Command
     */
    public $action;

    /**
     * Required setup option types in provided options object
     * @param $definition Definition
     * @param $options static|\stdClass
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Command\Option::create()
            ->setDescription('Root action')
            ->setIsUnnamed()
            //->addToEnum(V1::definition(), '')
            ->addToEnum(V1::definition(), 'v1');

        $definition->description = 'Helloelo, bich!';
    }

    public function performAction()
    {
        try {
            $this->action->performAction();
        } catch (Exception $e) {
            var_dump($e->query);
        }
    }

}