<?php

declare(strict_types=1);

namespace OAuth2ServerExamples\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701140859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create scopes table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE scopes ( '
            . 'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '
            . 'identifier VARCHAR(255) NOT NULL, '
            . 'description VARCHAR(255))';

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('scopes');
    }
}
