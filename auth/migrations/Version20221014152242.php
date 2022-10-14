<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014152242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_token (id INT AUTO_INCREMENT NOT NULL, client_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', expiry_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_id INT DEFAULT NULL, scopes LONGTEXT DEFAULT NULL, revoked TINYINT(1) NOT NULL, INDEX IDX_9315F04EDC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_token ADD CONSTRAINT FK_9315F04EDC2902E0 FOREIGN KEY (client_id_id) REFERENCES auth_client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_token DROP FOREIGN KEY FK_9315F04EDC2902E0');
        $this->addSql('DROP TABLE auth_token');
    }
}
