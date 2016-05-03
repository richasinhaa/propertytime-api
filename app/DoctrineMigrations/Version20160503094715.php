<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create table nl_listing_detail
 */
class Version20160503094715 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_listing_detail (
            id INT AUTO_INCREMENT NOT NULL,
            listing_type varchar(128) NOT NULL,
            count INTEGER DEFAULT 0,
            small_image_path varchar(128) DEFAULT null,
            large_image_path varchar(128) DEFAULT null,
            created_at DATETIME DEFAULT NULL,
            deleted BOOLEAN DEFAULT FALSE,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP table nl_listing_detail");

    }
}
