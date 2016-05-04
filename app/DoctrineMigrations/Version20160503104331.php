<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Create neighbourhood table mapping table for agency and neighbourhood
 */
class Version20160503104331 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_neighbourhood (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            deleted BOOLEAN DEFAULT FALSE,
            score NUMERIC(10,2) DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        $this->addSql("CREATE TABLE nl_agency_neighbourhood (
            id INT AUTO_INCREMENT NOT NULL,
            agency_id INTEGER NOT NULL,
            neighbourhood_id INTEGER NOT NULL,
            deleted BOOLEAN DEFAULT FALSE,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        $this->addSql("ALTER TABLE nl_neighbourhood ADD INDEX IDX_16AE8UT23UY78TY98 (name)");
        $this->addSql("ALTER TABLE nl_agency_neighbourhood ADD INDEX IDX_16AE178UI78RT32Q (agency_id)");
        $this->addSql("ALTER TABLE nl_agency_neighbourhood ADD INDEX IDX_16AE187TY56RT21F (neighbourhood_id)");

        $this->addSql("ALTER TABLE bf_company ADD COLUMN score NUMERIC(10,2) DEFAULT NULL");
        $this->addSql("ALTER TABLE bf_company ADD INDEX IDX_16AE187TY56OI892 (score)");

        $this->addSql("ALTER TABLE nl_neighbourhood ADD INDEX IDX_16AE187TY56OLYU6 (score)");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_neighbourhood");
        $this->addSql("DROP TABLE nl_agency_neighbourhood");
        $this->addSql("ALTER TABLE bf_company DROP COLUMN score");

    }
}
