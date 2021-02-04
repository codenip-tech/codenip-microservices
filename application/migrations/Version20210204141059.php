<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204141059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adds `user.code`';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE user ADD code VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE user DROP code');
    }
}
