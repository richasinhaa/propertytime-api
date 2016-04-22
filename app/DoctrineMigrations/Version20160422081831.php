<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * nl_listing_detail_table
 */
class Version20160422081831 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
       $this->addSql("CREATE TABLE nl_listing_detail (
            id INT AUTO_INCREMENT NOT NULL,
            listing_id INTEGER NOT NULL,
            image_id INTEGER  NOT NULL,
            image_loc VARCHAR(255)  NOT NULL,
            created_on DATETIME NOT NULL,
            modified_at DATETIME NOT NULL,
            created_by INTEGER DEFAULT NULL,
            modified_by INTEGER DEFAULT NULL,
            deleted TINYINT(1) NOT NULL,
            INDEX IDX_961E7F5D440C97FD (image_id),
            INDEX IDX_961E7F5D7D182D95 (listing_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $this->addSql("DROP TABLE nl_listing_detail"); 

    }
}
