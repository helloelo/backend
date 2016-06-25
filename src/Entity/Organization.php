<?php

namespace Helloelo\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class Organization extends Entity
{
    public $idOrganization;
    public $name;
    public $domain;

    /**
     * @param \stdClass|static $columns
     */
    static function setUpColumns($columns)
    {
        $columns->idOrganization = Column::AUTO_ID;
        $columns->name = Column::STRING + Column::NOT_NULL;
        $columns->domain = Column::create(Column::STRING + Column::NOT_NULL)->setUnique();
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setSchemaName('organization');
    }
    /**
     * // Organization is the model for organization
     * type Organization struct {
     * IDOrganization uint64 `db:"id_organization" json:"id_organisation"`
     * Name           string `db:"name" json:"organization_name"`
     * Domain         string `db:"domain" json:"organization_domain"`
     * }
 */



}