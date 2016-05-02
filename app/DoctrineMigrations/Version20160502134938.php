<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create table nl_summary
 */
class Version20160502134938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_summary (
            id INT AUTO_INCREMENT NOT NULL,
            properties INTEGER DEFAULT 0,
            users INTEGER DEFAULT 0,
            properties_added_last_24_hours INTEGER  DEFAULT 0,
            properties_sold_or_rented INTEGER DEFAULT 0,
            created_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        //Temp query, table will be populated by PopulateSummaryCommand
        $this->addSql("insert into nl_summary values(1, 65828, 1198, 0, 65828, now())");


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_summary");

    }
}
