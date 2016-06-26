<?php

namespace Helloelo\Api\V1;

use Helloelo\Entity\Notification;
use Helloelo\Entity\Player;
use Yaoi\Command;
use Yaoi\Command\Definition;

class PostNotification extends AuthRequired
{

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
    }

    public function performAction()
    {
        $result = ['status' => 'success'];
        try {
            $notification = new Notification();
            $notification->accepted($this->accepted);
            $notification->idNotificationType($this->idNotificationType);
            $notification->findOrSave();
        } catch (\Exception $e) {
            $result = ['status' => 'error', 'message' => $e->getMessage()];
        }

        return $result;
    }

}