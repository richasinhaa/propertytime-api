<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Add manager photo and cover photo in bf_company
 */
class Version20160902133608 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE bf_company add column manager_photo varchar(500) DEFAULT NULL");
        $this->addSql("ALTER TABLE bf_company add column cover_photo varchar(500) DEFAULT NULL");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE bf_company drop column manager_photo");
        $this->addSql("ALTER TABLE bf_company drop column cover_photo");

    }
}
