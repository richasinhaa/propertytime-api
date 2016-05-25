<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160525081208 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_updated_user (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INTEGER NOT NULL,
            email VARCHAR(500) DEFAULT NULL,
            phone_number VARCHAR(50) DEFAULT NULL,
            admin_approved TINYINT(1) DEFAULT 0,
            created_at DATETIME NOT NULL,
            modified_at DATETIME NOT NULL,
            deleted TINYINT(1) DEFAULT 0,
            INDEX idx_update_user_user_id (user_id),
            INDEX idx_update_user_email (email),
            INDEX idx_update_user_phone (phone_number),
            INDEX idx_update_user_modified (modified_at),
            INDEX idx_update_user_created (created_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $this->addSql("DROP TABLE nl_updated_user");

    }
}
