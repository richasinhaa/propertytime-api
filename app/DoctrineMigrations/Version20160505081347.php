<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create experts table
 */
class Version20160505081347 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_experts (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(200) DEFAULT NULL,
            profile VARCHAR(100) DEFAULT NULL,
            description LONGTEXT  NOT NULL,
            image_path VARCHAR(255) NOT NULL,
            phone VARCHAR(100) DEFAULT NULL,
            email VARCHAR(255) NOT NULL,
            address VARCHAR(500) DEFAULT NULL,
            city VARCHAR(100) NOT NULL,
            country VARCHAR(100) NOT NULL,
            expertise VARCHAR(100) NOT NULL,
            created_at DATETIME NOT NULL,
            deleted TINYINT(1) NOT NULL,
            INDEX IDX_961E787YU5182D95 (name),
            INDEX IDX_9667YU56ERE87JK1 (email),
            INDEX IDX_961E78YU09GH7U95 (city),
            INDEX IDX_9TY56ER98UY87JK1 (country),
            INDEX IDX_9TUI78RT67GF7JK1 (expertise),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_experts");

    }
}
