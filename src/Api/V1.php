<?php

namespace Helloelo\Api;


use Helloelo\Api\V1\AuthRequired;
use Helloelo\Api\V1\Games;
use Helloelo\Api\V1\Init;
use Helloelo\Api\V1\Login;
use Helloelo\Entity\Session;
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
            ->addToEnum(Login::definition(), 'login')
            ->addToEnum(Init::definition(), 'init')
            ->addToEnum(Games::definition(), 'games')
        ;

    }

    public function performAction()
    {
        try {
            if ($this->action instanceof AuthRequired) {
                if (!isset($_COOKIE[AuthRequired::TOKEN])) {
                    throw new ClientException("Session token required");
                }
                $session = Session::findByPrimaryKey($_COOKIE[AuthRequired::TOKEN]);
                if (!$session) {
                    throw new ClientException("BAd session token");
                }
                $this->action->playerId = $session->playerId;

            }
            $result = $this->action->performAction();
        }
        catch (ClientException $exception) {
            http_response_code(400);
            $result = array('error' => $exception->getMessage());
        }
        catch (\Exception $exception) {
            http_response_code(500);
            $result = array('error' => $exception->getMessage());
        }

        header("Content-Type: text/javascript");
        echo json_encode($result);
        exit();
    }


}