<?php

namespace Helloelo\Api;


use Helloelo\Api\V1\Oauth;
use Yaoi\Command;
use Yaoi\Command\Definition;

class V1 extends Command
{
    /**
     * @var Command
     */
    public $action;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Command\Option::create()
            ->setIsUnnamed()
            ->addToEnum(Oauth::definition(), 'oauth');

    }

    public function performAction()
    {
        $result = $this->action->performAction();
        header("Content-Type: text/javascript");
        echo json_encode($result);
        exit();
    }


}