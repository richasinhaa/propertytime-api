<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Table for users who asked for agencies' number
 */
class Version20160523090615 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_user_agency (
            id INT AUTO_INCREMENT NOT NULL,
            user_id VARCHAR(200) DEFAULT NULL,
            agency_id VARCHAR(100) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            deleted TINYINT(1) NOT NULL,
            INDEX idx_user_agency_userid (user_id),
            INDEX idx_user_agency_agencyid (agency_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $this->addSql("DROP TABLE nl_user_agency");

    }
}
