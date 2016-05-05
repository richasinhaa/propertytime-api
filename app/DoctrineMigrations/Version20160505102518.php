<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * create table nl_favorites
 */
class Version20160505102518 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE nl_favorites (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INTEGER NOT NULL,
            listing_id INTEGER NOT NULL,
            liked TINYINT(1)  DEFAULT 0,
            created_on DATETIME NOT NULL,
            modified_on DATETIME NOT NULL,
            deleted TINYINT(1) DEFAULT 0,
            INDEX IDX_96UI78TY56KJ0D95 (user_id),
            INDEX IDX_9667YUI7856J7JK1 (listing_id),
            INDEX IDX_961E7IU89BG09J95 (liked),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_favorites");
    }
}
