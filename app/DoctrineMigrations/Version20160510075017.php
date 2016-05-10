<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Insert into neighbourhood metrics a new column for 'Dubai' which is average taken from bf_reidin
 */
class Version20160510075017 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('insert into nl_neighbourhood_metrics(neighbourhood_name, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values (\'Dubai\', 1367, 8.5, 15.6, 7.8, 88.4 )');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('delete from nl_neighbourhood_metrics where neighbourhood_name = \'Dubai\'');

    }
}
