<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * New neighbouhood mappings - rewrites the old one
 */
class Version20160522135022 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('insert into nl_neighbourhood (name) values (\'Dubai Marina\')');
        $this->addSql('update nl_neighbourhood set deleted = 0 where name in (\'Palm Jumeirah\', \'Jumeirah Lakes Towers\',\'Remraam\', \'DIFC\', \'Business Bay\', \'Victory Heights\', \'Dubai Marina\', \'Jumeirah Islands\', \'Jumeirah Lakes Towers\', \'The Villa\')');

        $this->addSql('truncate nl_neighbourhood_metrics');

        $this->addSql('insert into nl_neighbourhood_metrics(neighbourhood_name, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield,occupancy)
            select CountyName,SalePrice,RentalValue,MaintenanceCost,AnnualGrossYield,Occupancy from bf_reidin where CountyName in (\'Palm Jumeirah\', \'Jumeirah Lakes Towers\',\'Remraam\', \'DIFC\', \'Business Bay\', \'Victory Heights\', \'Dubai Marina\', \'Jumeirah Islands\', \'Jumeirah Lakes Towers\', \'The Villa\')');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Palm Jumeirah\') where neighbourhood_name = \'Palm Jumeirah\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Jumeirah Lakes Towers\') where neighbourhood_name = \'Jumeirah Lakes Towers\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Remraam\') where neighbourhood_name = \'Remraam\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'DIFC\') where neighbourhood_name = \'DIFC\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Business Bay\') where neighbourhood_name = \'Business Bay\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Victory Heights\') where neighbourhood_name = \'Victory Heights\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Dubai Marina\') where neighbourhood_name = \'Dubai Marina\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Jumeirah Islands\') where neighbourhood_name = \'Jumeirah Islands\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'Jumeirah Lakes Towers\') where neighbourhood_name = \'Jumeirah Lakes Towers\'');

        $this->addSql('update nl_neighbourhood_metrics set neighbourhood_id = (select id from nl_neighbourhood where name = \'The Villa\') where neighbourhood_name = \'The Villa\'');

        //Data for below query from
        //select community, company_id from bf_listing where community in ('Palm Jumeirah', 'Downtown Dubai','Dubai Marina', 'JBR - Jumeirah Beach Residence', 'Motor City', 'International City', 'Dubai Silicon Oasis')
        //and company_id is not null
        //group by company_id,community

        $this->addSql('update nl_agency_neighbourhood set deleted = 1 where deleted = 0');

        $neighbourhoodAgency = array(
                array('neighbourhood_id' => 119, 'agency_id' => 17),
                array('neighbourhood_id' => 138, 'agency_id' => 17),
                array('neighbourhood_id' => 322, 'agency_id' => 17),
                array('neighbourhood_id' => 257, 'agency_id' => 17),
                array('neighbourhood_id' => 309, 'agency_id' => 17),
                array('neighbourhood_id' => 119, 'agency_id' => 18),
                array('neighbourhood_id' => 138, 'agency_id' => 18),
                array('neighbourhood_id' => 322, 'agency_id' => 18),
                array('neighbourhood_id' => 201, 'agency_id' => 18),
                array('neighbourhood_id' => 257, 'agency_id' => 18),
                array('neighbourhood_id' => 297, 'agency_id' => 18),
                array('neighbourhood_id' => 309, 'agency_id' => 18),
                array('neighbourhood_id' => 119, 'agency_id' => 20),
                array('neighbourhood_id' => 138, 'agency_id' => 20),
                array('neighbourhood_id' => 322, 'agency_id' => 20),
                array('neighbourhood_id' => 201, 'agency_id' => 20),
                array('neighbourhood_id' => 257, 'agency_id' => 20),
                array('neighbourhood_id' => 297, 'agency_id' => 20),
                array('neighbourhood_id' => 309, 'agency_id' => 20),
                array('neighbourhood_id' => 119, 'agency_id' => 21),
                array('neighbourhood_id' => 322, 'agency_id' => 21),
                array('neighbourhood_id' => 201, 'agency_id' => 21),
                array('neighbourhood_id' => 257, 'agency_id' => 21),
                array('neighbourhood_id' => 119, 'agency_id' => 22),
                array('neighbourhood_id' => 138, 'agency_id' => 22),
                array('neighbourhood_id' => 322, 'agency_id' => 22),
                array('neighbourhood_id' => 201, 'agency_id' => 22),
                array('neighbourhood_id' => 257, 'agency_id' => 22),
                array('neighbourhood_id' => 269, 'agency_id' => 22),
                array('neighbourhood_id' => 119, 'agency_id' => 23),
                array('neighbourhood_id' => 138, 'agency_id' => 23),
                array('neighbourhood_id' => 322, 'agency_id' => 23),
                array('neighbourhood_id' => 201, 'agency_id' => 23),
                array('neighbourhood_id' => 257, 'agency_id' => 23),
                array('neighbourhood_id' => 119, 'agency_id' => 24),
                array('neighbourhood_id' => 138, 'agency_id' => 24),
                array('neighbourhood_id' => 322, 'agency_id' => 24),
                array('neighbourhood_id' => 201, 'agency_id' => 24),
                array('neighbourhood_id' => 257, 'agency_id' => 24),
                array('neighbourhood_id' => 119, 'agency_id' => 25),
                array('neighbourhood_id' => 322, 'agency_id' => 25),
                array('neighbourhood_id' => 201, 'agency_id' => 25),
                array('neighbourhood_id' => 257, 'agency_id' => 25),
                array('neighbourhood_id' => 119, 'agency_id' => 26),
                array('neighbourhood_id' => 138, 'agency_id' => 26),
                array('neighbourhood_id' => 322, 'agency_id' => 26),
                array('neighbourhood_id' => 201, 'agency_id' => 26),
                array('neighbourhood_id' => 257, 'agency_id' => 26),
                array('neighbourhood_id' => 119, 'agency_id' => 28),
                array('neighbourhood_id' => 138, 'agency_id' => 28),
                array('neighbourhood_id' => 322, 'agency_id' => 28),
                array('neighbourhood_id' => 201, 'agency_id' => 28),
                array('neighbourhood_id' => 257, 'agency_id' => 28),
                array('neighbourhood_id' => 297, 'agency_id' => 28),
                array('neighbourhood_id' => 309, 'agency_id' => 28),
                array('neighbourhood_id' => 119, 'agency_id' => 29),
                array('neighbourhood_id' => 138, 'agency_id' => 29),
                array('neighbourhood_id' => 322, 'agency_id' => 29),
                array('neighbourhood_id' => 201, 'agency_id' => 29),
                array('neighbourhood_id' => 257, 'agency_id' => 29),
                array('neighbourhood_id' => 309, 'agency_id' => 29),
                array('neighbourhood_id' => 119, 'agency_id' => 31),
                array('neighbourhood_id' => 138, 'agency_id' => 31),
                array('neighbourhood_id' => 322, 'agency_id' => 31),
                array('neighbourhood_id' => 201, 'agency_id' => 31),
                array('neighbourhood_id' => 257, 'agency_id' => 31),
                array('neighbourhood_id' => 119, 'agency_id' => 32),
                array('neighbourhood_id' => 138, 'agency_id' => 32),
                array('neighbourhood_id' => 322, 'agency_id' => 32),
                array('neighbourhood_id' => 201, 'agency_id' => 32),
                array('neighbourhood_id' => 257, 'agency_id' => 32),
                array('neighbourhood_id' => 119, 'agency_id' => 34),
                array('neighbourhood_id' => 138, 'agency_id' => 34),
                array('neighbourhood_id' => 322, 'agency_id' => 34),
                array('neighbourhood_id' => 201, 'agency_id' => 34),
                array('neighbourhood_id' => 257, 'agency_id' => 34),
                array('neighbourhood_id' => 297, 'agency_id' => 34),
                array('neighbourhood_id' => 309, 'agency_id' => 34),
                array('neighbourhood_id' => 119, 'agency_id' => 35),
                array('neighbourhood_id' => 138, 'agency_id' => 35),
                array('neighbourhood_id' => 322, 'agency_id' => 35),
                array('neighbourhood_id' => 201, 'agency_id' => 35),
                array('neighbourhood_id' => 257, 'agency_id' => 35),
                array('neighbourhood_id' => 297, 'agency_id' => 35),
                array('neighbourhood_id' => 309, 'agency_id' => 35),
                array('neighbourhood_id' => 119, 'agency_id' => 36),
                array('neighbourhood_id' => 138, 'agency_id' => 36),
                array('neighbourhood_id' => 322, 'agency_id' => 36),
                array('neighbourhood_id' => 201, 'agency_id' => 36),
                array('neighbourhood_id' => 257, 'agency_id' => 36),
                array('neighbourhood_id' => 297, 'agency_id' => 36),
                array('neighbourhood_id' => 309, 'agency_id' => 36),
                array('neighbourhood_id' => 119, 'agency_id' => 37),
                array('neighbourhood_id' => 322, 'agency_id' => 37),
                array('neighbourhood_id' => 257, 'agency_id' => 37),
                array('neighbourhood_id' => 119, 'agency_id' => 38),
                array('neighbourhood_id' => 138, 'agency_id' => 38),
                array('neighbourhood_id' => 322, 'agency_id' => 38),
                array('neighbourhood_id' => 201, 'agency_id' => 38),
                array('neighbourhood_id' => 257, 'agency_id' => 38),
                array('neighbourhood_id' => 119, 'agency_id' => 39),
                array('neighbourhood_id' => 138, 'agency_id' => 39),
                array('neighbourhood_id' => 322, 'agency_id' => 39),
                array('neighbourhood_id' => 201, 'agency_id' => 39),
                array('neighbourhood_id' => 257, 'agency_id' => 39),
                array('neighbourhood_id' => 297, 'agency_id' => 39),
                array('neighbourhood_id' => 309, 'agency_id' => 39),
                array('neighbourhood_id' => 322, 'agency_id' => 41),
                array('neighbourhood_id' => 201, 'agency_id' => 41),
                array('neighbourhood_id' => 257, 'agency_id' => 41),
                array('neighbourhood_id' => 119, 'agency_id' => 42),
                array('neighbourhood_id' => 138, 'agency_id' => 42),
                array('neighbourhood_id' => 322, 'agency_id' => 42),
                array('neighbourhood_id' => 257, 'agency_id' => 42),
                array('neighbourhood_id' => 297, 'agency_id' => 42),
                array('neighbourhood_id' => 119, 'agency_id' => 43),
                array('neighbourhood_id' => 138, 'agency_id' => 43),
                array('neighbourhood_id' => 322, 'agency_id' => 43),
                array('neighbourhood_id' => 257, 'agency_id' => 43),
                array('neighbourhood_id' => 309, 'agency_id' => 43),
                array('neighbourhood_id' => 119, 'agency_id' => 44),
                array('neighbourhood_id' => 138, 'agency_id' => 44),
                array('neighbourhood_id' => 322, 'agency_id' => 44),
                array('neighbourhood_id' => 257, 'agency_id' => 44),
                array('neighbourhood_id' => 297, 'agency_id' => 44),
                array('neighbourhood_id' => 309, 'agency_id' => 44),
                array('neighbourhood_id' => 119, 'agency_id' => 45),
                array('neighbourhood_id' => 138, 'agency_id' => 45),
                array('neighbourhood_id' => 322, 'agency_id' => 45),
                array('neighbourhood_id' => 201, 'agency_id' => 45),
                array('neighbourhood_id' => 257, 'agency_id' => 45),
                array('neighbourhood_id' => 309, 'agency_id' => 45),
                array('neighbourhood_id' => 119, 'agency_id' => 46),
                array('neighbourhood_id' => 138, 'agency_id' => 46),
                array('neighbourhood_id' => 322, 'agency_id' => 46),
                array('neighbourhood_id' => 201, 'agency_id' => 46),
                array('neighbourhood_id' => 257, 'agency_id' => 46),
                array('neighbourhood_id' => 309, 'agency_id' => 46),
                array('neighbourhood_id' => 119, 'agency_id' => 47),
                array('neighbourhood_id' => 138, 'agency_id' => 47),
                array('neighbourhood_id' => 322, 'agency_id' => 47),
                array('neighbourhood_id' => 201, 'agency_id' => 47),
                array('neighbourhood_id' => 257, 'agency_id' => 47),
                array('neighbourhood_id' => 297, 'agency_id' => 47),
                array('neighbourhood_id' => 309, 'agency_id' => 47),
                array('neighbourhood_id' => 119, 'agency_id' => 48),
                array('neighbourhood_id' => 138, 'agency_id' => 48),
                array('neighbourhood_id' => 322, 'agency_id' => 48),
                array('neighbourhood_id' => 201, 'agency_id' => 48),
                array('neighbourhood_id' => 257, 'agency_id' => 48),
                array('neighbourhood_id' => 119, 'agency_id' => 49),
                array('neighbourhood_id' => 138, 'agency_id' => 49),
                array('neighbourhood_id' => 322, 'agency_id' => 49),
                array('neighbourhood_id' => 257, 'agency_id' => 49),
                array('neighbourhood_id' => 309, 'agency_id' => 49),
                array('neighbourhood_id' => 119, 'agency_id' => 50),
                array('neighbourhood_id' => 322, 'agency_id' => 50),
                array('neighbourhood_id' => 138, 'agency_id' => 51),
                array('neighbourhood_id' => 119, 'agency_id' => 52),
                array('neighbourhood_id' => 138, 'agency_id' => 52),
                array('neighbourhood_id' => 322, 'agency_id' => 52),
                array('neighbourhood_id' => 201, 'agency_id' => 52),
                array('neighbourhood_id' => 257, 'agency_id' => 52),
                array('neighbourhood_id' => 297, 'agency_id' => 52),
                array('neighbourhood_id' => 309, 'agency_id' => 52),
                array('neighbourhood_id' => 119, 'agency_id' => 53),
                array('neighbourhood_id' => 138, 'agency_id' => 53),
                array('neighbourhood_id' => 322, 'agency_id' => 53),
                array('neighbourhood_id' => 257, 'agency_id' => 53),
                array('neighbourhood_id' => 119, 'agency_id' => 54),
                array('neighbourhood_id' => 138, 'agency_id' => 54),
                array('neighbourhood_id' => 322, 'agency_id' => 54),
                array('neighbourhood_id' => 201, 'agency_id' => 54),
                array('neighbourhood_id' => 257, 'agency_id' => 54),
                array('neighbourhood_id' => 297, 'agency_id' => 54),
                array('neighbourhood_id' => 309, 'agency_id' => 54),
                array('neighbourhood_id' => 119, 'agency_id' => 55),
                array('neighbourhood_id' => 138, 'agency_id' => 55),
                array('neighbourhood_id' => 322, 'agency_id' => 55),
                array('neighbourhood_id' => 257, 'agency_id' => 55),
                array('neighbourhood_id' => 297, 'agency_id' => 55),
                array('neighbourhood_id' => 309, 'agency_id' => 55),
                array('neighbourhood_id' => 119, 'agency_id' => 56),
                array('neighbourhood_id' => 138, 'agency_id' => 56),
                array('neighbourhood_id' => 322, 'agency_id' => 56),
                array('neighbourhood_id' => 257, 'agency_id' => 56),
                array('neighbourhood_id' => 119, 'agency_id' => 59),
                array('neighbourhood_id' => 138, 'agency_id' => 59),
                array('neighbourhood_id' => 322, 'agency_id' => 59),
                array('neighbourhood_id' => 257, 'agency_id' => 59),
                array('neighbourhood_id' => 119, 'agency_id' => 60),
                array('neighbourhood_id' => 322, 'agency_id' => 60),
                array('neighbourhood_id' => 257, 'agency_id' => 60),
                array('neighbourhood_id' => 309, 'agency_id' => 60),
                array('neighbourhood_id' => 119, 'agency_id' => 61),
                array('neighbourhood_id' => 138, 'agency_id' => 61),
                array('neighbourhood_id' => 322, 'agency_id' => 61),
                array('neighbourhood_id' => 257, 'agency_id' => 61),
                array('neighbourhood_id' => 119, 'agency_id' => 62),
                array('neighbourhood_id' => 322, 'agency_id' => 62),
                array('neighbourhood_id' => 201, 'agency_id' => 62),
                array('neighbourhood_id' => 257, 'agency_id' => 62),
                array('neighbourhood_id' => 119, 'agency_id' => 63),
                array('neighbourhood_id' => 138, 'agency_id' => 63),
                array('neighbourhood_id' => 322, 'agency_id' => 63),
                array('neighbourhood_id' => 257, 'agency_id' => 63),
                array('neighbourhood_id' => 119, 'agency_id' => 64),
                array('neighbourhood_id' => 138, 'agency_id' => 64),
                array('neighbourhood_id' => 322, 'agency_id' => 64),
                array('neighbourhood_id' => 201, 'agency_id' => 64),
                array('neighbourhood_id' => 257, 'agency_id' => 64),
                array('neighbourhood_id' => 309, 'agency_id' => 64),
                array('neighbourhood_id' => 119, 'agency_id' => 65),
                array('neighbourhood_id' => 138, 'agency_id' => 65),
                array('neighbourhood_id' => 322, 'agency_id' => 65),
                array('neighbourhood_id' => 201, 'agency_id' => 65),
                array('neighbourhood_id' => 257, 'agency_id' => 65),
                array('neighbourhood_id' => 119, 'agency_id' => 66),
                array('neighbourhood_id' => 138, 'agency_id' => 66),
                array('neighbourhood_id' => 322, 'agency_id' => 66),
                array('neighbourhood_id' => 201, 'agency_id' => 66),
                array('neighbourhood_id' => 257, 'agency_id' => 66),
                array('neighbourhood_id' => 309, 'agency_id' => 66),
                array('neighbourhood_id' => 119, 'agency_id' => 67),
                array('neighbourhood_id' => 138, 'agency_id' => 67),
                array('neighbourhood_id' => 322, 'agency_id' => 67),
                array('neighbourhood_id' => 201, 'agency_id' => 67),
                array('neighbourhood_id' => 257, 'agency_id' => 67),
                array('neighbourhood_id' => 297, 'agency_id' => 67),
                array('neighbourhood_id' => 309, 'agency_id' => 67),
                array('neighbourhood_id' => 119, 'agency_id' => 68),
                array('neighbourhood_id' => 138, 'agency_id' => 68),
                array('neighbourhood_id' => 322, 'agency_id' => 68),
                array('neighbourhood_id' => 257, 'agency_id' => 68),
                array('neighbourhood_id' => 297, 'agency_id' => 68),
                array('neighbourhood_id' => 309, 'agency_id' => 68),
                array('neighbourhood_id' => 119, 'agency_id' => 69),
                array('neighbourhood_id' => 138, 'agency_id' => 69),
                array('neighbourhood_id' => 322, 'agency_id' => 69),
                array('neighbourhood_id' => 201, 'agency_id' => 69),
                array('neighbourhood_id' => 257, 'agency_id' => 69),
                array('neighbourhood_id' => 119, 'agency_id' => 70),
                array('neighbourhood_id' => 138, 'agency_id' => 70),
                array('neighbourhood_id' => 322, 'agency_id' => 70),
                array('neighbourhood_id' => 201, 'agency_id' => 70),
                array('neighbourhood_id' => 257, 'agency_id' => 70),
                array('neighbourhood_id' => 309, 'agency_id' => 70),
                array('neighbourhood_id' => 119, 'agency_id' => 71),
                array('neighbourhood_id' => 138, 'agency_id' => 71),
                array('neighbourhood_id' => 322, 'agency_id' => 71),
                array('neighbourhood_id' => 201, 'agency_id' => 71),
                array('neighbourhood_id' => 257, 'agency_id' => 71),
                array('neighbourhood_id' => 119, 'agency_id' => 72),
                array('neighbourhood_id' => 138, 'agency_id' => 72),
                array('neighbourhood_id' => 322, 'agency_id' => 72),
                array('neighbourhood_id' => 257, 'agency_id' => 72),
                array('neighbourhood_id' => 119, 'agency_id' => 73),
                array('neighbourhood_id' => 138, 'agency_id' => 73),
                array('neighbourhood_id' => 322, 'agency_id' => 73),
                array('neighbourhood_id' => 201, 'agency_id' => 73),
                array('neighbourhood_id' => 257, 'agency_id' => 73),
                array('neighbourhood_id' => 119, 'agency_id' => 74),
                array('neighbourhood_id' => 201, 'agency_id' => 74),
                array('neighbourhood_id' => 119, 'agency_id' => 76),
                array('neighbourhood_id' => 322, 'agency_id' => 76),
                array('neighbourhood_id' => 257, 'agency_id' => 76),
                array('neighbourhood_id' => 269, 'agency_id' => 76),
                array('neighbourhood_id' => 119, 'agency_id' => 77),
                array('neighbourhood_id' => 322, 'agency_id' => 77),
                array('neighbourhood_id' => 257, 'agency_id' => 77),
                array('neighbourhood_id' => 322, 'agency_id' => 78),
                array('neighbourhood_id' => 257, 'agency_id' => 78),
                array('neighbourhood_id' => 119, 'agency_id' => 79),
                array('neighbourhood_id' => 138, 'agency_id' => 79),
                array('neighbourhood_id' => 322, 'agency_id' => 79),
                array('neighbourhood_id' => 201, 'agency_id' => 79),
                array('neighbourhood_id' => 257, 'agency_id' => 79),
                array('neighbourhood_id' => 309, 'agency_id' => 79),
                array('neighbourhood_id' => 119, 'agency_id' => 80),
                array('neighbourhood_id' => 138, 'agency_id' => 80),
                array('neighbourhood_id' => 322, 'agency_id' => 80),
                array('neighbourhood_id' => 202, 'agency_id' => 80),
                array('neighbourhood_id' => 257, 'agency_id' => 80),
                array('neighbourhood_id' => 119, 'agency_id' => 81),
                array('neighbourhood_id' => 138, 'agency_id' => 81),
                array('neighbourhood_id' => 322, 'agency_id' => 81),
                array('neighbourhood_id' => 201, 'agency_id' => 81),
                array('neighbourhood_id' => 257, 'agency_id' => 81),
                array('neighbourhood_id' => 297, 'agency_id' => 81),
                array('neighbourhood_id' => 119, 'agency_id' => 82),
                array('neighbourhood_id' => 138, 'agency_id' => 82),
                array('neighbourhood_id' => 322, 'agency_id' => 82),
                array('neighbourhood_id' => 201, 'agency_id' => 82),
                array('neighbourhood_id' => 257, 'agency_id' => 82),
                array('neighbourhood_id' => 119, 'agency_id' => 85),
                array('neighbourhood_id' => 138, 'agency_id' => 85),
                array('neighbourhood_id' => 322, 'agency_id' => 85),
                array('neighbourhood_id' => 202, 'agency_id' => 85),
                array('neighbourhood_id' => 257, 'agency_id' => 85),
                array('neighbourhood_id' => 269, 'agency_id' => 85),
                array('neighbourhood_id' => 119, 'agency_id' => 86),
                array('neighbourhood_id' => 138, 'agency_id' => 86),
                array('neighbourhood_id' => 322, 'agency_id' => 86),
                array('neighbourhood_id' => 201, 'agency_id' => 86),
                array('neighbourhood_id' => 257, 'agency_id' => 86),
                array('neighbourhood_id' => 297, 'agency_id' => 86),
                array('neighbourhood_id' => 309, 'agency_id' => 86),
                array('neighbourhood_id' => 119, 'agency_id' => 87),
                array('neighbourhood_id' => 138, 'agency_id' => 87),
                array('neighbourhood_id' => 322, 'agency_id' => 87),
                array('neighbourhood_id' => 257, 'agency_id' => 87),
                array('neighbourhood_id' => 297, 'agency_id' => 87),
                array('neighbourhood_id' => 309, 'agency_id' => 87),
                array('neighbourhood_id' => 119, 'agency_id' => 89),
                array('neighbourhood_id' => 138, 'agency_id' => 89),
                array('neighbourhood_id' => 322, 'agency_id' => 89),
                array('neighbourhood_id' => 201, 'agency_id' => 89),
                array('neighbourhood_id' => 257, 'agency_id' => 89),
                array('neighbourhood_id' => 269, 'agency_id' => 89),
                array('neighbourhood_id' => 297, 'agency_id' => 89),
                array('neighbourhood_id' => 119, 'agency_id' => 90),
                array('neighbourhood_id' => 322, 'agency_id' => 90),
                array('neighbourhood_id' => 257, 'agency_id' => 90),
                array('neighbourhood_id' => 119, 'agency_id' => 92),
                array('neighbourhood_id' => 138, 'agency_id' => 92),
                array('neighbourhood_id' => 322, 'agency_id' => 92),
                array('neighbourhood_id' => 201, 'agency_id' => 92),
                array('neighbourhood_id' => 257, 'agency_id' => 92),
                array('neighbourhood_id' => 297, 'agency_id' => 92),
                array('neighbourhood_id' => 309, 'agency_id' => 92),
                array('neighbourhood_id' => 119, 'agency_id' => 93),
                array('neighbourhood_id' => 138, 'agency_id' => 93),
                array('neighbourhood_id' => 322, 'agency_id' => 93),
                array('neighbourhood_id' => 201, 'agency_id' => 93),
                array('neighbourhood_id' => 257, 'agency_id' => 93),
                array('neighbourhood_id' => 309, 'agency_id' => 93),
                array('neighbourhood_id' => 119, 'agency_id' => 94),
                array('neighbourhood_id' => 138, 'agency_id' => 94),
                array('neighbourhood_id' => 322, 'agency_id' => 94),
                array('neighbourhood_id' => 201, 'agency_id' => 94),
                array('neighbourhood_id' => 257, 'agency_id' => 94),
                array('neighbourhood_id' => 119, 'agency_id' => 95),
                array('neighbourhood_id' => 322, 'agency_id' => 95),
                array('neighbourhood_id' => 257, 'agency_id' => 95),
                array('neighbourhood_id' => 297, 'agency_id' => 95),
                array('neighbourhood_id' => 119, 'agency_id' => 96),
                array('neighbourhood_id' => 138, 'agency_id' => 96),
                array('neighbourhood_id' => 322, 'agency_id' => 96),
                array('neighbourhood_id' => 119, 'agency_id' => 97),
                array('neighbourhood_id' => 138, 'agency_id' => 97),
                array('neighbourhood_id' => 322, 'agency_id' => 97),
                array('neighbourhood_id' => 201, 'agency_id' => 97),
                array('neighbourhood_id' => 257, 'agency_id' => 97),
                array('neighbourhood_id' => 309, 'agency_id' => 97),
                array('neighbourhood_id' => 119, 'agency_id' => 98),
                array('neighbourhood_id' => 322, 'agency_id' => 98),
                array('neighbourhood_id' => 257, 'agency_id' => 98),
                array('neighbourhood_id' => 119, 'agency_id' => 99),
                array('neighbourhood_id' => 138, 'agency_id' => 99),
                array('neighbourhood_id' => 322, 'agency_id' => 99),
                array('neighbourhood_id' => 257, 'agency_id' => 99),
                array('neighbourhood_id' => 322, 'agency_id' => 100),
                array('neighbourhood_id' => 119, 'agency_id' => 101),
                array('neighbourhood_id' => 138, 'agency_id' => 101),
                array('neighbourhood_id' => 322, 'agency_id' => 101),
                array('neighbourhood_id' => 201, 'agency_id' => 101),
                array('neighbourhood_id' => 257, 'agency_id' => 101),
                array('neighbourhood_id' => 297, 'agency_id' => 101),
                array('neighbourhood_id' => 138, 'agency_id' => 102),
                array('neighbourhood_id' => 322, 'agency_id' => 102),
                array('neighbourhood_id' => 119, 'agency_id' => 103),
                array('neighbourhood_id' => 138, 'agency_id' => 103),
                array('neighbourhood_id' => 322, 'agency_id' => 103),
                array('neighbourhood_id' => 257, 'agency_id' => 103),
                array('neighbourhood_id' => 119, 'agency_id' => 104),
                array('neighbourhood_id' => 119, 'agency_id' => 105),
                array('neighbourhood_id' => 138, 'agency_id' => 105),
                array('neighbourhood_id' => 322, 'agency_id' => 105),
                array('neighbourhood_id' => 201, 'agency_id' => 105),
                array('neighbourhood_id' => 257, 'agency_id' => 105),
                array('neighbourhood_id' => 322, 'agency_id' => 107),
                array('neighbourhood_id' => 257, 'agency_id' => 107),
                array('neighbourhood_id' => 119, 'agency_id' => 108),
                array('neighbourhood_id' => 138, 'agency_id' => 108),
                array('neighbourhood_id' => 322, 'agency_id' => 108),
                array('neighbourhood_id' => 257, 'agency_id' => 108),
                array('neighbourhood_id' => 119, 'agency_id' => 109),
                array('neighbourhood_id' => 138, 'agency_id' => 109),
                array('neighbourhood_id' => 322, 'agency_id' => 109),
                array('neighbourhood_id' => 257, 'agency_id' => 109),
                array('neighbourhood_id' => 119, 'agency_id' => 110),
                array('neighbourhood_id' => 322, 'agency_id' => 110),
                array('neighbourhood_id' => 257, 'agency_id' => 110),
                array('neighbourhood_id' => 119, 'agency_id' => 111),
                array('neighbourhood_id' => 138, 'agency_id' => 111),
                array('neighbourhood_id' => 322, 'agency_id' => 111),
                array('neighbourhood_id' => 201, 'agency_id' => 111),
                array('neighbourhood_id' => 257, 'agency_id' => 111),
                array('neighbourhood_id' => 119, 'agency_id' => 112),
                array('neighbourhood_id' => 138, 'agency_id' => 112),
                array('neighbourhood_id' => 322, 'agency_id' => 112),
                array('neighbourhood_id' => 201, 'agency_id' => 112),
                array('neighbourhood_id' => 257, 'agency_id' => 112),
                array('neighbourhood_id' => 297, 'agency_id' => 112),
                array('neighbourhood_id' => 309, 'agency_id' => 112),
                array('neighbourhood_id' => 119, 'agency_id' => 114),
                array('neighbourhood_id' => 138, 'agency_id' => 114),
                array('neighbourhood_id' => 322, 'agency_id' => 115),
                array('neighbourhood_id' => 257, 'agency_id' => 115),
                array('neighbourhood_id' => 119, 'agency_id' => 118),
                array('neighbourhood_id' => 322, 'agency_id' => 118),
                array('neighbourhood_id' => 257, 'agency_id' => 118));

        foreach($neighbourhoodAgency as $naData) {
            $this->addSql("insert into nl_agency_neighbourhood(agency_id, neighbourhood_id) 
                values ({$naData['agency_id']}, {$naData['neighbourhood_id']})");
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('delete from nl_neighbourhood where name in (\'Dubai Marina\')');
        $this->addSql('update nl_agency_neighbourhood set deleted = 0 where deleted = 1');
        $this->addSql('truncate table nl_neighbourhood_metrics');
    }
}
