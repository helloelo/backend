<?php

namespace Helloelo\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Player extends Entity
{
    public $idPlayer;
    public $fkOrganization;
    public $name;
    public $email;
    public $picture;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->idPlayer = Column::AUTO_ID;
        $columns->fkOrganization = Organization::columns()->idOrganization;
        $columns->name = Column::STRING + Column::NOT_NULL;
        $columns->email = Column::STRING + Column::NOT_NULL;
        $columns->picture = Column::STRING + Column::NOT_NULL;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('player');
    }
    /**
     * // Player is the model for player
     * type Player struct {
     * IDPlayer     uint64 `db:"id_player" json:"id_player"`
     * Name         string `db:"player" json:"player_name"`
     * Email        string `db:"email" json:"player_email"`
     * Organization uint64 `db:"fk_organization" json:"id_organization"`
     * }
 */


}