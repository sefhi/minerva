<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102203940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3B536FDE7927C74 ON auth_user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3B536FD35C246D5 ON auth_user (password)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A3B536FDE7927C74 ON auth_user');
        $this->addSql('DROP INDEX UNIQ_A3B536FD35C246D5 ON auth_user');
    }
}
