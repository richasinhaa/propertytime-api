<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160714102749 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
         $this->addSql("CREATE TABLE nl_logs (
            id INT AUTO_INCREMENT NOT NULL,
            search VARCHAR(500) DEFAULT NULL,
            search_from VARCHAR(500) DEFAULT NULL,
            property_id INT DEFAULT NULL,
            agency_id INT DEFAULT NULL,
            contacted TINYINT(1) DEFAULT NULL,
            liked TINYINT(1) DEFAULT NULL,
            user_id INTEGER DEFAULT NULL,
            created_at DATETIME NOT NULL,
            INDEX idx_search (search),
            INDEX idx_search_from (search_from),
            INDEX idx_property_id (property_id),
            INDEX idx_agency_id (agency_id),
            INDEX idx_contacted (contacted),
            INDEX idx_liked (liked),
            INDEX idx_usr_id (user_id),
            INDEX idx_update_user_created (created_at),
            PRIMARY KEY(id) 
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_logs");

    }
}
