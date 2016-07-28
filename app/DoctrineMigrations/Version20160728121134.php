<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160728121134 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_experts drop column profile');
        $this->addSql('ALTER TABLE nl_experts add column relevent_exp FLOAT(5,2) DEFAULT 0.0');
        $this->addSql('ALTER TABLE nl_experts add column job_title VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts add column intro VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts add column facebook VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts add column twitter VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts add column google VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts add column linkedin VARCHAR(200) DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE nl_experts add column profile VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE nl_experts drop column relevent_exp');
        $this->addSql('ALTER TABLE nl_experts drop column job_title');
        $this->addSql('ALTER TABLE nl_experts drop column intro');
        $this->addSql('ALTER TABLE nl_experts drop column facebook');
        $this->addSql('ALTER TABLE nl_experts drop column twitter');
        $this->addSql('ALTER TABLE nl_experts drop column google');
        $this->addSql('ALTER TABLE nl_experts drop column linkedin');


    }
}
