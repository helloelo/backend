<?php

namespace Helloelo\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Elo extends Entity
{
    /*
     * // Elo is the model for elo
type Elo struct {
	IDPlayer uint64 `db:"fk_player" json:"id_player"`
	IDGame   uint64 `db:"fk_game" json:"id_game"`
	Value    uint64 `db:"value" json:"elo_value"`
}
     */

    public $fkPlayer;
    public $fkGame;
    public $value;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->fkPlayer = Player::columns()->idPlayer;
        $columns->fkGame = Game::columns()->idGame;
        $columns->value = Column::INTEGER + Column::UNSIGNED + Column::NOT_NULL;
    }

    /**
     * @param Table $table
     * @param \stdClass|static $columns
     */
    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('elo');
        $table->setPrimaryKey($columns->fkPlayer, $columns->fkGame);
    }
}