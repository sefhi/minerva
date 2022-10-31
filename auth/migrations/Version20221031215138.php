<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031215138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', password VARCHAR(255) NOT NULL, email VARCHAR(150) NOT NULL, roles JSON NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_token ADD user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP user');
        $this->addSql('ALTER TABLE auth_token ADD CONSTRAINT FK_9315F04EA76ED395 FOREIGN KEY (user_id) REFERENCES auth_user (id)');
        $this->addSql('CREATE INDEX IDX_9315F04EA76ED395 ON auth_token (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_token DROP FOREIGN KEY FK_9315F04EA76ED395');
        $this->addSql('DROP TABLE auth_user');
        $this->addSql('DROP INDEX IDX_9315F04EA76ED395 ON auth_token');
        $this->addSql('ALTER TABLE auth_token ADD user VARCHAR(36) DEFAULT NULL, DROP user_id');
    }
}
