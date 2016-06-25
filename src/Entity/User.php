<?php

namespace Helloelo\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class User extends Entity
{
    public $id;
    public $name;
    public $email;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->name = Column::STRING;
        $columns->email = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }


}