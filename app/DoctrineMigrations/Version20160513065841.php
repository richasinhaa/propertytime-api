<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create nl_reviews table
 */
class Version20160513065841 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_reviews (
        id INT AUTO_INCREMENT NOT NULL,
            agency_id INTEGER NOT NULL,
            agent_id INTEGER DEFAULT NULL,
            agent_name VARCHAR(400) DEFAULT NULL,
            customer_name VARCHAR(400) NOT NULL,
            nationality VARCHAR(200) DEFAULT NULL,
            phone VARCHAR(30) NOT NULL,
            email VARCHAR(200) NOT NULL,
            review_title VARCHAR(200) DEFAULT NULL,
            review_desc VARCHAR(1000) DEFAULT NULL,
            rating INTEGER DEFAULT 0,
            file_id INTEGER DEFAULT NULL,
            admin_approved TINYINT(1) DEFAULT 0,
            deleted TINYINT(1) DEFAULT 0,
            created_at DATETIME NOT NULL,
            modified_at DATETIME NOT NULL,
            INDEX idx_review_agency_id (agency_id),
            INDEX idx_review_agent_id  (agent_id),
            INDEX idx_review_title  (review_title),
            INDEX idx_review_rating (rating),
            INDEX idx_review_file_id (rating),
            INDEX idx_review_created (created_at),
            INDEX idx_review_modified (modified_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_reviews");

    }
}
