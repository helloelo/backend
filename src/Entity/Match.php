<?php

namespace Helloelo\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Entity;

class Match extends Entity
{
    public $idMatch;
    public $fkGame;
    public $player1;
    public $player2;
    public $player1Score;
    public $player2Score;
    public $createdAt;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->idMatch = Column::AUTO_ID;
        $columns->fkGame = Game::columns()->idGame;
        $columns->player1 = Player::columns()->idPlayer;
        $columns->player2 = Player::columns()->idPlayer;
        $columns->player1Score = Column::INTEGER;
        $columns->player2Score = Column::INTEGER;
        $columns->createdAt = Column::TIMESTAMP;
    }


    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('match');
    }

    /*
     * // Match is the model for matches
    type Match struct {
        IDMatch      uint64    `db:"id_match" json:"id_match"`
        IDGame       uint64    `db:"fk_game" json:"id_game"`
        Player1      []Player  `db:"player1" json:"player1"`
        Player2      []Player  `db:"player2" json:"player2"`
        Player1Score int       `db:"player1_score" json:"player1_score"`
        Player2Score int       `db:"player2_score" json:"player2_score"`
        CreatedAt    time.Time `db:"created_at" json:"created_at"`
    }

     */
    
}