<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160606122657 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_neighbourhood add COLUMN video LONGTEXT DEFAULT NULL');
        $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/iL4tbJTAZAU" frameborder="0" allowfullscreen></iframe>';
        $this->addSql("UPDATE nl_neighbourhood set video = '{$video}' where deleted = 0");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_neighbourhood drop COLUMN video');

    }
}
