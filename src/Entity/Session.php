<?php

namespace Helloelo\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Session extends Entity
{
    public $token;
    public $playerId;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->token = Column::create(Column::STRING + Column::NOT_NULL)->setUnique();
        $columns->playerId = Player::columns()->idPlayer;
    }

    /**
     * @param Table $table
     * @param \stdClass|static $columns
     */
    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('session')->setPrimaryKey($columns->token);
    }


}