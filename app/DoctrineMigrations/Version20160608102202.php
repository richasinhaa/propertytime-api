<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160608102202 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('alter table nl_reviews modify agent_name varchar(255) default null');
        $this->addSql('alter table nl_reviews modify review_desc varchar(255) default null');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('alter table nl_reviews modify agent_name varchar(255) default not null');
        $this->addSql('alter table nl_reviews modify review_desc varchar(255) default not null');

    }
}
