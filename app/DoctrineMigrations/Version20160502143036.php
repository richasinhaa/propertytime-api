<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create table nl_neighbourhood_metrics
 */
class Version20160502143036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `nl_neighbourhood_metrics` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `neighbourhood_name` varchar(128) NOT NULL DEFAULT 'N.A',
              `neighbourhood_id` bigint(20) NOT NULL DEFAULT '0',
              `avg_sales_price` float NOT NULL DEFAULT '0',
              `avg_rental_value` float NOT NULL DEFAULT '0',
              `maintenance_fee` float NOT NULL DEFAULT '0',
              `annual_gross_yield` float NOT NULL DEFAULT '0',
              `occupancy` float NOT NULL DEFAULT '0',
              `deleted`   tinyint(1) DEFAULT FALSE,
              PRIMARY KEY (`id`),
              UNIQUE KEY `neighbourhood_id` (`neighbourhood_id`,`neighbourhood_name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_neighbourhood_metrics");

    }
}
