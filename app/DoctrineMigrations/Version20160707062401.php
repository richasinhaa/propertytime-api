<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Add social media handles in bf_agent and bf_company tables
 */
class Version20160707062401 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER table bf_agent
            ADD COLUMN facebook_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN instagram_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN twitter_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN twitter_snippet LONGTEXT DEFAULT NULL
            ');

        $this->addSql('ALTER table bf_company
            ADD COLUMN facebook_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN instagram_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN twitter_url VARCHAR(500) DEFAULT NULL,
            ADD COLUMN twitter_snippet LONGTEXT DEFAULT NULL
            ');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE bf_agent 
            DROP COLUMN facebook_url, 
            DROP COLUMN instagram_url, 
            DROP COLUMN twitter_url, 
            DROP COLUMN twitter_snippet');

        $this->addSql('ALTER TABLE bf_company 
            DROP COLUMN facebook_url, 
            DROP COLUMN instagram_url, 
            DROP COLUMN twitter_url, 
            DROP COLUMN twitter_snippet');

    }
}
