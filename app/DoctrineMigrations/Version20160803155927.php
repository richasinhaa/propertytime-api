<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * nl_contact_agency
 */
class Version20160803155927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_contact_agency (
            id INT AUTO_INCREMENT NOT NULL,
            agency_id INT NOT NULL,
            name VARCHAR(200) DEFAULT NULL,
            email VARCHAR(500) DEFAULT NULL,
            phone VARCHAR(255)  DEFAULT NULL,
            customer_type VARCHAR(200) DEFAULT NULL,
            enquiry LONGTEXT DEFAULT NULL,
            keep_informed TINYINT(1)  DEFAULT 0,
            created_on DATETIME NOT NULL,
            modified_on DATETIME NOT NULL,
            deleted TINYINT(1) NOT NULL,
            INDEX idx_cust_type (customer_type),
            INDEX idx_cust_name (name),
            INDEX idx_cust_phn (phone),
            INDEX idx_cust_mail (email),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_contact_agency");

    }
}
