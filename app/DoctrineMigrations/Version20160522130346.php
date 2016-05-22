<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Dubai added to neighbourhood, to support [POST] neighbourhood enquiry for Dubai area
 */
class Version20160522130346 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('insert into nl_neighbourhood(name, deleted) values (\'Dubai\', 0)');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("delete from nl_neighbourhood where name like '%Dubai%'");

    }
}
