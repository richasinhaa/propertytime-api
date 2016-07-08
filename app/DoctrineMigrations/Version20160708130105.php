<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160708130105 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE bf_listing add COLUMN facilities LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE bf_unused_category add COLUMN facilities LONGTEXT DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE bf_listing add COLUMN facilities LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE bf_unused_category add COLUMN facilities LONGTEXT DEFAULT NULL');

    }
}
