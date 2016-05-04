<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create nl_neighbourhood_enquiry table
 */
class Version20160504090922 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_neighbourhood_enquiry (
            id INT AUTO_INCREMENT NOT NULL,
            neighbourhood_id INTEGER NOT NULL,
            contact_name VARCHAR(255) DEFAULT NULL,
            email varchar(255) DEFAULT NULL,
            phone varchar(100) DEFAULT NULL,
            type varchar(20) NOT NULL,
            created_at DATETIME DEFAULT NULL,
            deleted BOOLEAN DEFAULT FALSE,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        $this->addSql("ALTER TABLE nl_neighbourhood_enquiry ADD INDEX IDX_16AE23NH7KJ45Y (neighbourhood_id)");
        $this->addSql("ALTER TABLE nl_neighbourhood_enquiry ADD INDEX IDX_16AS23HJ8RT78TY (type)");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_neighbourhood_enquiry");

    }
}
