<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105235231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_refresh_token (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', token_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', expiry DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', revoked TINYINT(1) NOT NULL, INDEX IDX_C0DCFD8541DEE7B9 (token_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_refresh_token ADD CONSTRAINT FK_C0DCFD8541DEE7B9 FOREIGN KEY (token_id) REFERENCES auth_token (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_refresh_token DROP FOREIGN KEY FK_C0DCFD8541DEE7B9');
        $this->addSql('DROP TABLE auth_refresh_token');
    }
}
