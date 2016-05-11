<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create nl_blogs table
 */
class Version20160511080013 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_blogs (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(200) NOT NULL,
            description LONGTEXT DEFAULT NULL,
            blog_url LONGTEXT NOT NULL,
            image_path VARCHAR(200) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            modified_at DATETIME NOT NULL,
            visible TINYINT(1) DEFAULT 0,
            INDEX idx_blog_name (name),
            INDEX idx_blog_url (blog_url),
            INDEX idx_blog_created (created_at),
            INDEX idx_blog_modified (modified_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_blogs");

    }
}
