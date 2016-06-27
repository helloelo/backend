<?php

namespace Helloelo\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Notification extends Entity
{
    public $idNotification;
    public $idNotificationType;
    public $fkPlayer;
    public $accepted;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->idNotification = Column::AUTO_ID;
        $columns->fkPlayer = Player::columns()->idPlayer;
        $columns->notificationType = Column::INTEGER + Column::NOT_NULL;
        $columns->accepted = Column::INTEGER + Column::NOT_NULL + Column::SIZE_1B;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('notification');
    }


    /**
     * // Notification is the model related to notifications
     * type Notification struct {
     * IDNotification     uint64 `db:"id_notification" json:"id_notification"`
     * IDNotificationType int    `db:"fk_notification_type" json:"id_notification_type"`
     * Accepted           bool   `db:"accepted" json:"accepted"`
     * }
 */

}