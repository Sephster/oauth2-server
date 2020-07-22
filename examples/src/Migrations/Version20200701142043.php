<?php

declare(strict_types=1);

namespace OAuth2ServerExamples\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701142043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create users table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE users ( '
             . 'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, '
             . 'username VARCHAR(255) NOT NULL, '
             . 'password VARCHAR(255) NOT NULL)';

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('users');
    }
}
