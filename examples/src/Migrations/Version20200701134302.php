<?php

declare(strict_types=1);

namespace OAuth2ServerExamples\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701134302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create the client table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE clients ( '
             . 'id INT UNSIGNED AUTO_INCREMEMENT PRIMARY KEY, '
             . 'name VARCHAR(255) NOT NULL, '
             . 'secret VARCHAR(255) NOT NULL, '
             . 'redirect_uri VARCHAR(255) NOT NULL, '
             . 'confidential BOOLEAN NOT NULL)';

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('clients');
    }
}
