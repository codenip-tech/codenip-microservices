<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210204093644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates `user` table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL, name VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) DEFAULT NULL, created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, UNIQUE INDEX U_user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE user');
    }
}
