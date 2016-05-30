<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160530084635 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_reviews
            add column professionalism float(8,2) DEFAULT NULL,
            add column local_market_knowledge float(8,2) DEFAULT NULL,
            add column responsiveness float(8,2) DEFAULT NULL,
            add column process_expertise float(8,2) DEFAULT NULL,
            add column after_sales_service float(8,2) DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_reviews 
            drop column professionalism, 
            drop column local_market_knowledge, 
            drop column responsiveness,
            drop column process_expertise,  
            drop column after_sales_service');

    }
}
