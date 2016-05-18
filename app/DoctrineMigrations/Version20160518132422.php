<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160518132422 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_documents (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(200) NOT NULL,
            doc_path LONGTEXT DEFAULT NULL,
            doc_type VARCHAR(200)  DEFAULT NULL,
            doc_size BIGINT DEFAULT NULL,
            created_at DATETIME NOT NULL,
            deleted TINYINT(1) NOT NULL DEFAULT 0,
            INDEX idx_document_name (name),
            INDEX idx_document_type (doc_type),
            INDEX idx_document_created(created_at),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_documents");

    }
}
