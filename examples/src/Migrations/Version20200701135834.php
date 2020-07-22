<?php

declare(strict_types=1);

namespace OAuth2ServerExamples\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701135834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create access tokens table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE access_tokens ( '
             . 'id INT UNSIGNED AUTO_INCREMEMENT PRIMARY KEY, '
             . 'user_id INT UNSIGNED NOT NULL, '
             . 'client_id INT UNSIGNED NOT NULL, '
             . 'scopes VARCHAR(255) NOT NULL, '
             . 'expiry_date_time DATETIME NOT NULL, '
             . 'revoked BOOL NOT NULL DEFAULT FALSE)';

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('access_tokens');
    }
}
