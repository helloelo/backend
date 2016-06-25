<?php

namespace Helloelo\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Game extends Entity
{
/*
 * // Game is the model for game
type Game struct {
	IDGame         uint64 `db:"id_game" json:"id_game"`
	Name           string `db:"name" json:"game_name"`
	IDOrganization uint64 `db:"fk_organization" json:"id_organization"`
}

 */
    public $idGame;
    public $name;
    public $fkOrganization;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->idGame = Column::AUTO_ID;
        $columns->fkOrganization = Organization::columns()->idOrganization;
        $columns->name = Column::STRING + Column::NOT_NULL;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('game');
    }

}