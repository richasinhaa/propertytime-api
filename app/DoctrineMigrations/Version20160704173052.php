<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160704173052 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_advertisements (
            id INT AUTO_INCREMENT NOT NULL,
            img_path VARCHAR(500) DEFAULT NULL,
            redirect_to VARCHAR(500) DEFAULT NULL,
            page VARCHAR(500) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            deleted TINYINT(1) DEFAULT 0,
            INDEX idx_path (img_path),
            INDEX idx_redirect (redirect_to),
            INDEX idx_page (page),
            INDEX idx_update_user_created (created_at),
            PRIMARY KEY(id) 
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_advertisements");

    }
}
