<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Add is_sold column to bf_listing table
 */
class Version20160504075428 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        //updating modified_on because ass is_sold was throwing
        // MySQL Incorrect datetime value: '0000-00-00 00:00:00' on modified_on
        $this->addSql("UPDATE bf_listing set modified_on=NULL");
        $this->addSql("ALTER TABLE bf_listing ADD COLUMN is_sold TINYINT(1) DEFAULT 0");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE bf_listing DROP COLUMN is_sold");

    }
}
